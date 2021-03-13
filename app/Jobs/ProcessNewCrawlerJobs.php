<?php

namespace App\Jobs;

use App\Models\CrawlerJob;
use App\Services\ScraperService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNewCrawlerJobs
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $crwlerJob;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( CrawlerJob $crawlerJob)
    {

        $this->crwlerJob = $crawlerJob;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(ScraperService $scraperService)
    {
        $jobs = $this->crwlerJob->where('status', 0)->get();

        foreach ($jobs as $job){
            $this->crwlerJob->findOrfail($job->id)->update(['started_at'=> Carbon::now()]);
            foreach ($job->urls as $url){
                $data = $scraperService->scrap($url->url);

                if(isset($data->success) ) {
                    $title = $data->data['titles'][0];
                    foreach ($data->data['paragraph'] as $paragraph){

                        $url->articles()->create([
                            'title' => $title,
                            'text' => $paragraph,
                        ]);
                    }
                }else{
                    $url->update([ 'status' => true ]);
                }
            }
            $this->crwlerJob->findOrfail($job->id)->update(['finished_at'=> Carbon::now()]);
            $this->crwlerJob->findOrfail($job->id)->update(['status'=> true]);
        }
    }
}
