<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\News\Parser;

class GatherArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:gather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulls the articles from all the sources in the database.';
    protected $parse;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->parse = new Parser();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->parse->gatherArticles();
    }
}
