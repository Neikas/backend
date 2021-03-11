<?php

namespace App\Http\Controllers\Api;

use App\Events\CreateNewJobForCrawlerEvent;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Models\CrawlerJob;
use App\Models\Job;
use App\Models\Url;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
    public function store(JobRequest $request)
    {
        $job = CrawlerJob::create([
            'url' => $request->urls
        ]);

        event(new CreateNewJobForCrawlerEvent( $job ) );

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
