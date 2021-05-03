<?php

namespace Tests\Unit;

use App\Rules\ValidFeed;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ValidFeedTest extends TestCase
{
    public function test_valid_feed()
    {
        Http::fake(function () {
            return Http::response(file_get_contents(__DIR__ . '/../fixtures/feed.xml'));
        });

        $this->assertTrue((new ValidFeed())->passes('link', 'https://example.org/rss.xml'));
    }

    public function test_invalid_feed()
    {
        Http::fake(function () {
            return Http::response(file_get_contents(__DIR__ . '/../fixtures/invalid-feed.xml'));
        });

        $this->assertFalse((new ValidFeed())->passes('link', 'https://example.org/rss.xml'));
    }

    public function test_fails_on_http_server_error()
    {
        Http::fake(fn () => Http::response('', 500));

        $this->assertFalse((new ValidFeed())->passes('link', 'https://example.org/rss.xml'));
    }
}
