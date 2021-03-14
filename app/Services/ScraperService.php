<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;


class ScraperService
{
    /**
     * Make a call to to specified url and return formatted data
     *
     * @param $url
     *
     * @return Object
     */
    public function scrap($url)
    {
        $data = ( object ) [
            'status' => true,
            'title' => 'Title not found',
            'paragraph' => [
                'Failed scraping any paragraph tags'
            ],
            'message' => ''
        ];

        $client = new Client(HttpClient::create(['timeout' => 60]));
        try {
            $crawler = $client->request('GET', $url->url);
        } catch (\Exception $e) {

            $data->status = false;
            $data->errorMessage = $e->getMessage();

            return $data;
        }
        //Handles empty
        if(!$crawler->filter('title')->count() == 0 )
        {
            $data->title = $crawler->filter('title')->first()->text();
        }

        if(!$crawler->filter('p')->count() == 0 )
        {
            $data->paragraph = $crawler->filter('p')->each(function ($node) {
                return $node->text();
            });
        }

        return $data;
    }
}
