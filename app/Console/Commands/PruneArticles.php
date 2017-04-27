<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Article;
use Carbon\Carbon;
use DB;

class PruneArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:prune';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes articles that are over a week old!';

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
     * @return mixed
     */
    public function handle()
    {
        $currentDate = Carbon::now()->subDays(7);

        Article::where(DB::raw('date(published_date)'), '<=', $currentDate)->delete();
    }
}
