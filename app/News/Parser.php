<?php

namespace App\News;

use Carbon\Carbon;

use Feeds;
use App\Source;
use App\Article;
use App\Jobs\ParseAndSaveArticles;

use Log;

class Parser {
	protected $feed;
	protected $guzzle;
	protected $summly;

	public function __construct(){
	}
	public function getInfo(){
	}
	public function feed($url){
		$this->feed = Feeds::make($url);
		$this->feed->handle_content_type();

		return $this->feed;
	}
	public function gatherArticles(){
		$titles = [];
		// $articles = collect($this->feed('http://feeds.gawker.com/deadspin/full')->get_items());
		$sources = collect(Source::all());

		$sources->each(function($source){
			$articles = collect($this->feed($source->rss)->get_items());
			$articles->each(function($item) use ($source){
				if(Article::where('guid', $item->get_id() . '-' . preg_replace("![^a-z0-9]+!i", "-", $source->name))->first()){
					// Log::info('Parser made it to the most recent article for ' . $source->name);
					return false;
				}

				$job = (new ParseAndSaveArticles($item, $this->feed->get_title()));

				dispatch($job);
			});
		});
	}
}