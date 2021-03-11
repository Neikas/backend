<?php

namespace App\Listeners;

use App\Http\Controllers\ScraperController;
use App\Models\Article;
use App\Services\ScraperService;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddJobToCralwerListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $scraperService = new ScraperService();
        $scraper = new ScraperController();

        $data = $scraper->index($scraperService, $event->job->url);

        $event->job->update([
            'status' => true,
            'finished_at' => now(),
            ]);
        $article = new Article();
        $article->title = $data->title;
        $article->text = $data->paragraph;

        $event->job->articles()->save($article);

    }
}
