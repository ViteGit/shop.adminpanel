<?php

namespace App\Service;


class ConjugaisonService
{
    private $url = 'https://glagol.reverso.net/спряжение-русский-глагол-{verb}.html';

    private $guzzleService;

    public function __construct(GuzzleService $guzzleService)
    {
        $this->guzzleService = $guzzleService;
    }

    /**
     * @param string $verb
     *
     * @param string $time
     * @param int $person
     * @throws \Exception
     */
    public function conjugation(string $verb, string $time = 'present', $person = 3)
    {
        $content = $this->guzzleService->getContent(preg_replace('~{verb}~', $verb, $this->url));



        echo $content;die;
//        dump($content) ;die;
    }

}