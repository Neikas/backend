<?php

namespace App\Services;

use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;


class ScraperService
{
    /**
     * Make a call to to specified url and return formatted data
     *
     * @param  string  $url
     *
     * @return array
     */
    public function scrap($url)
    {

        $client = new Client(HttpClient::create(['timeout' => 60]));

        try {
            $crawler = $client->request('GET', $url);
        } catch (\Exception $e) {

            return ['failed' => true, 'message' => $e->getMessage()];
        }
        //Get the title of the website
        $titles = $crawler->filter('title')->each(function ($node) {
            return $node->text();
        });
        //Get p tag
        $paragraph = $crawler->filter('p')->each(function ($node) {
            return $node->text();
        });

        return ( object ) ['title' => $titles[0], 'paragraph' => $paragraph[0]];
    }
}
