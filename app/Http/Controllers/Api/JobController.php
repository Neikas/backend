<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Jobs\ProcessNewCrawlerJobs;
use App\Models\CrawlerJob;
use App\Models\Job;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = CrawlerJob::orderBy('started_at', 'DESC')->get();

        return JobResource::collection($jobs);
    }

    //for testing
    public function run()
    {
        $crwlerJob = new CrawlerJob();

        ProcessNewCrawlerJobs::dispatch($crwlerJob);
    }

    public function store(JobRequest $request)
    {
        $crawlerJob = CrawlerJob::create();

        foreach ($request->urls as $url) {
            $crawlerJob->urls()->create([
                'url' => $url
            ]);
        }

        return response()->json([
            'success' => 'Job added to succesfully!',
            'id' => $crawlerJob->id
        ])->setStatusCode(202);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CrawlerJob  $crawlerJob
     * @return \Illuminate\Http\Response
     */
    public function status(CrawlerJob $crawlerJob)
    {
        $urls = $crawlerJob->urls()->get();

        $countFalse = $urls->countBy(function($url){
            return $url->status == false;
        })->first() ;
        $urlCount = $urls->count();

        if($countFalse == 0  ){

            $precentage = 100;
        }else {
            $precentage = ($countFalse / $urlCount) * 100;
        }

        return response()->json(['status' => $crawlerJob->status, 'percentage' =>$precentage ]);
    }

}
