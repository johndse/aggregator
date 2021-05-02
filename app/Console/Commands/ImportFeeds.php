<?php

namespace App\Console\Commands;

use App\Jobs\ImportFeed;
use App\Models\Feed;
use Illuminate\Console\Command;

class ImportFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:feeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import feeds.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $feeds = Feed::all();

        foreach ($feeds as $feed) {
            ImportFeed::dispatch($feed);
        }
    }
}
