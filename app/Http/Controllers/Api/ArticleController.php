<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleShowResource;
use App\Models\CrawlerJob;

class ArticleController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  $id

     */
    public function show($id)
    {
        $job = CrawlerJob::findOrFail($id);

        $articles = $job->urls()->with('articles')->get();

        return ArticleShowResource::collection($articles);
    }
}
