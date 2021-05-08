<?php

namespace Tests\Feature;

use App\Models\Feed;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CreateFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_see_create_feeds_screen()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('feeds.create'));

        $response->assertStatus(200);
    }

    public function test_guest_user_cannot_see_create_feeds_screen()
    {
        $response = $this->get(route('feeds.create'));
        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_create_feed()
    {
        $user = User::factory()->create();

        Http::fake([
            'example.org/*' => Http::response(file_get_contents(__DIR__ . '/../fixtures/feed.xml')),
        ]);

        $attributes = [
            'name' => 'Foo',
            'link' => 'http://example.org/feed.xml',
        ];

        $response = $this->actingAs($user)->post(route('feeds.store'), $attributes);

        $feed = Feed::where($attributes)->firstOrFail();

        $response->assertRedirect(route('feeds.show', ['feed' => $feed]));
    }

    public function test_guest_user_cannot_create_feed()
    {
        $attributes = [
            'name' => 'Foo',
            'link' => 'http://example.org/feed.xml',
        ];

        $response = $this->post(route('feeds.store'), $attributes);
        $response->assertRedirect('/login');
    }

}
