<?php

namespace App\Service;

use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Cookie\CookieJar;

class GuzzleService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $root;

    public function __construct()
    {
        $headers = [
            'Referer' => 'https://www.google.com',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; rv:68.0) Gecko/20100101 Firefox/68.0',
        ];


        $this->client = new Client([
            'headers' => $headers,
            'allow_redirects' => true,
            'defaults' => [
                'exceptions' => false,
            ],
        ]);
    }

    /**
     * @param string $fileUrl
     * @param string $filePath
     *
     * @return string
     */
    public function createFile(string $fileUrl, string $filePath): string
    {
        $resource = fopen($filePath, 'w+');

        $this->client->get($fileUrl, ['sink' => $resource]);

        return $filePath;
    }

    /**
     * @param string $fileUrl
     * @param string $relativePath
     *
     * @return string
     */
    public function createFileByRelativePath(string $fileUrl, string $relativePath): string
    {
//        root не оканчивается на слеш проверять перед тем как прописывать relativePath
        $resource = fopen("{$this->root}$relativePath", 'w+');

        $this->client->get($fileUrl, ['sink' => $resource]);

        return $relativePath;
    }

    /**
     * @param string $url
     * @param array $headers
     * @return string
     */
    public function getPage(string $url, array $headers = [])
    {
        return $this->client->get($url, [
            'headers' => $headers,
        ]);
    }

    /**
     * @param string $url
     * @param array $headers
     *
     * @return string
     *
     * @throws Exception
     */
    public function getContent(string $url, array $headers = []): string
    {
        $result = $this->client->get($url, [
            'headers' => $headers,
        ]);

        if ($statusCode = $result->getStatusCode() !== 200) {
            throw new Exception("url: $url, statusCode: $statusCode");
        }

        return (string)$result->getBody();
    }

    public function sendPost(string $url, array $options = [])
    {
        return $this->client->post($url, $options)->getBody()->getContents();
    }

    public function sendGet(string $url, array $options = [])
    {
        return $this->client->get($url, $options);
    }
}