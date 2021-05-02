<?php

namespace App\Jobs;

use App\Models\Feed;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Laminas\Feed\Reader\Reader;

class ImportFeed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The feed instance.
     *
     * @var Feed
     */
    protected $feed;

    /**
     * Create a new job instance.
     *
     * @param Feed $feed
     */
    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::retry(3, 100)->get($this->feed->link);

        $reader = Reader::importString($response->body());

        foreach ($reader as $entry) {
            $this->feed->entries()->updateOrCreate([
                'identifier' => $entry->getId(),
            ], [
                'identifier' => $entry->getId(),
                'title' => $entry->getTitle(),
                'link' => $entry->getLink(),
                'date_created' => $entry->getDateCreated(),
                'date_modified' => $entry->getDateModified(),
            ]);
        }
    }
}
