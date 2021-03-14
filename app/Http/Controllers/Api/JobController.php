<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Jobs\ProcessNewCrawlerJobs;
use App\Models\CrawlerJob;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $jobs = CrawlerJob::orderBy('started_at', 'DESC')->with('urls')->get();

        return JobResource::collection($jobs);
    }
    /**
     * Store new job
     *
     */
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
     * Return status and percentage of completion
     *
     * @param  \App\Models\CrawlerJob  $crawlerJob
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(CrawlerJob $crawlerJob)
    {
        $urls = $crawlerJob->urls()->get();
        $percentage = $urls->avg(function ($url) {
                return $url->status == true;
            }) * 100;

        $urlCompleted = $urls->filter(function ($url) {
            return $url->status == true;
        })->count();

        $urlCount = $urls->count();

        return response()->json([
            'status' => $crawlerJob->status,
            'percentage' => $percentage,
            'urlCount' => $urlCount,
            'urlCompleted' => $urlCompleted,
        ]);
    }


}
