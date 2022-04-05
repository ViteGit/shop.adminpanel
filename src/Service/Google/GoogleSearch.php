<?php

namespace App\Service\Google;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class GoogleSearch
{
    private $client;

    public function __construct()
    {
        $this->client = new Client(['allow_redirects' => true]);
    }

    public function topTeen(string $query)
    {
        $content = $this->client->get("https://www.google.com/search?q=$query")->getBody()->getContents();

        $node = new Crawler($content);

        $nodes = $node->filter('a div:first-child');

        return $nodes->each(function (Crawler $node): string {
            return $node->text();
        });
    }

}