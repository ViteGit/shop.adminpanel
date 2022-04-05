<?php

namespace App\Service\YandexApi;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class YandexTranslation
{
    private $client;

    public function __construct()
    {
        $headers = [
//            'Referer' => 'https://www.google.com',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; rv:68.0) Gecko/20100101 Firefox/68.0',
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Origin' => 'https://translate.yandex.ru',
        ];

        $this->client = new Client([
            'headers' => $headers,
        ]);
    }

    public function translate(string $text): ?string
    {

        try {
            $response = $this->client->post(
//                'https://translate.yandex.net/api/v1/tr.json/translate?id=e94ea370.5e963163.c46500ae-0-1&srv=tr-touch&lang=en-ru&reason=paste&format=text',
                'https://translate.yandex.net/api/v1/tr.json/translate?id=362bc6cb.5ecfc24c.a98e8c5c-0-0&srv=tr-text&lang=en-ru&reason=paste&format=text',
                [
                    'form_params' => [
                        'text' => $text,
                        'options' => 4
                    ]
                ]
            );
        } catch (\Exception $ex) {
            return null;
        }

        if (Response::HTTP_OK == $response->getStatusCode()) {
            $json = $response->getBody()->getContents();
            $result = json_decode($json,true);

            return $result['text'][0];
        }

        return null;
    }

}