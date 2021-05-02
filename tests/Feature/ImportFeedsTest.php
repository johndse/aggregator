<?php

namespace Tests\Feature;

use App\Jobs\ImportFeed;
use App\Models\Feed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ImportFeedsTest extends TestCase
{
    use RefreshDatabase;

    public function test_feed_import_queued()
    {
        Queue::fake();
        Feed::factory()->count(10)->create();

        $this->artisan('import:feeds');

        Queue::assertPushed(ImportFeed::class, 10);
    }
}
