<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use DivineOmega\PHPSummary\SummaryTool;

use App\Article;
use App\Source;

use Carbon\Carbon;

use Log;

class ParseAndSaveArticles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $item;
    protected $feedtitle;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($item, $feedTitle)
    {
        $this->item = $item;
        $this->feedtitle = $feedTitle;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        preg_match( '/src="([^"]*)"/i', $this->item->get_description(), $img );

        $date = Carbon::parse($this->item->get_date('Y-m-d H:i e'));
        $source = Source::where('name', $this->feedtitle)->first();
        $article = new Article();
        $article->guid = $this->item->get_id() . '-' . preg_replace("![^a-z0-9]+!i", "-", $this->feedtitle);
        $article->title = $this->item->get_title();
        $article->summary = str_replace('Read more...', '', strip_tags($this->item->get_description()));
        $article->published_date = $date;
        if(count($img)){
            $article->image = $img[1];
        }
        $article->url = $this->item->get_link();
        $article->source()->associate($source);
        $article->save();
    }
    public function failed(Exception $exception)
    {
        Log::info($exception);
    }
}
