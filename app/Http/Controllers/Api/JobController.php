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
        $jobs = CrawlerJob::all();

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

        return response()->json(['success' => 'Job added to succesfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function status(Job $job)
    {

        return response()->json(['status' => $job->status]);
    }

}
