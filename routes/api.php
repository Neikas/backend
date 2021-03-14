<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\JobController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('articles/show/{id}', [ArticleController::class, 'show']);
Route::post('job/store', [JobController::class, 'store']);
Route::get('job/index', [JobController::class, 'index']);
Route::get('job/status/{crawlerJob}', [JobController::class, 'status']);

