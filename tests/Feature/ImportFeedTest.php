<?php

namespace Tests\Feature;

use App\Jobs\ImportFeed;
use App\Models\Feed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Laminas\Feed\Reader\Exception\RuntimeException;
use Tests\TestCase;

class ImportFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_import_feed()
    {
        Http::fake(function () {
            return Http::response(file_get_contents(__DIR__ . '/../fixtures/feed.xml'));
        });

        $feed = Feed::factory()->create();

        $job = new ImportFeed($feed);
        $job->handle();

        $this->assertDatabaseCount('entries', 2);
        $this->assertDatabaseHas('entries', [
           'title' => 'Foo',
           'link' => 'http://www.example.com/blog/post/1',
        ]);
    }

    public function test_entry_can_be_updated()
    {
        Http::fakeSequence()
            ->pushFile(__DIR__ . '/../fixtures/feed.xml')
            ->pushFile(__DIR__ . '/../fixtures/feed-update.xml');

        $feed = Feed::factory()->create();

        $job = new ImportFeed($feed);
        $job->handle();

        $this->assertDatabaseCount('entries', 2);
        $this->assertDatabaseHas('entries', [
            'title' => 'Bar',
            'link' => 'http://www.example.com/blog/post/2',
        ]);

        $job->handle();

        $this->assertDatabaseCount('entries', 2);
        $this->assertDatabaseMissing('entries', [
            'title' => 'Bar',
        ]);
        $this->assertDatabaseHas('entries', [
            'title' => 'Foobar',
            'link' => 'http://www.example.com/blog/post/2',
        ]);
    }

    public function test_invalid_feed()
    {
        $this->expectException(RuntimeException::class);

        Http::fake(function () {
            return Http::response(file_get_contents(__DIR__ . '/../fixtures/invalid-feed.xml'));
        });

        $feed = Feed::factory()->create();

        $job = new ImportFeed($feed);
        $job->handle();
    }

    public function test_http_server_error()
    {
        $this->expectException(RequestException::class);

        Http::fakeSequence()
            ->pushStatus(500)
            ->pushStatus(500)
            ->pushStatus(500);

        $feed = Feed::factory()->create();

        $job = new ImportFeed($feed);
        $job->handle();
    }

    public function test_http_server_error_retry()
    {
        Http::fakeSequence()
            ->pushStatus(500)
            ->pushFile(__DIR__ . '/../fixtures/feed.xml');

        $feed = Feed::factory()->create();

        $job = new ImportFeed($feed);
        $job->handle();

        $this->assertDatabaseCount('entries', 2);
    }
}
