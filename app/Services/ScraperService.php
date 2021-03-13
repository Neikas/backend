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
            'title' => '',
            'paragraph' => [],
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

        $title = $crawler->filter('title')->first()->text();
        $paragraph = $crawler->filter('p')->each(function ($node) {
            return $node->text();
        });

        $data->title = $title;
        $data->paragraph = $paragraph;

        return $data;
    }
}
