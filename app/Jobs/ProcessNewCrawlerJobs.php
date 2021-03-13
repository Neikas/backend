<?php

namespace App\Jobs;

use App\Models\CrawlerJob;
use App\Services\UrlService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNewCrawlerJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $crawlerJob = new CrawlerJob();

        $jobs = $crawlerJob->where('status', 'pending')->get();

        foreach ($jobs as $job) {

            $job->update(['started_at' => Carbon::now()]);

            // Process url
            $urlServices = new UrlService();
            $urlServices->processUrls($job->urls()->get());

            $job->update(['finished_at' => Carbon::now()]);

            $job->update(['status' => 'Done']);
        }
    }
}
