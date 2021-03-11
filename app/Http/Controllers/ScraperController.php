<?php

namespace App\Http\Controllers;

use App\Services\ScraperService;

class ScraperController extends Controller
{
    public function index(ScraperService $scraperService, $url = null)
    {
        if($url === null){

            return false;
        }
        $data = $scraperService->scrap($url);

        return $data;
    }
}
