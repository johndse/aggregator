<?php

namespace Tests\Feature;

use App\Models\Feed;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UpdateFeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_see_edit_feed_screen()
    {
        $user = User::factory()->create();
        $feed = Feed::factory()->create();

        $response = $this->actingAs($user)->get(route('feeds.edit', ['feed' => $feed]));

        $response->assertStatus(200);
    }

    public function test_guest_user_cannot_see_edit_feed_screen()
    {
        $feed = Feed::factory()->create();

        $response = $this->get(route('feeds.edit', ['feed' => $feed]));
        $response->assertRedirect('/login');
    }

}
