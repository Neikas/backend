<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\JobController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('articles/show/{id}', [ArticleController::class, 'show']);
Route::post('job/store', [JobController::class, 'store']);
Route::get('job/index', [JobController::class, 'index']);
Route::get('job/status/{crawlerJob}', [JobController::class, 'status']);

