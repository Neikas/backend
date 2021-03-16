<?php

namespace App\Services;


class UrlService
{
    /**
     * Make a call to to specified url and return formatted data
     *
     * @param  $urls
     *
     * @return null
     */
    public function processUrls($urls)
    {
        $scraperService = new ScraperService();
        $articleService = new ArticleService();

        foreach ($urls as $url) {

            $data = $scraperService->scrap($url);
            $articleService->storeArticles($url, $data) ;
        }
    }
}
