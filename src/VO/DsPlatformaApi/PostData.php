<?php

namespace App\VO\DsPlatformaApi;

class PostData
{
    private $postCode;
    private $postStatusName;
    private $trackingUrl;

    /**
     * @param string $postCode
     * @param string $postStatusName
     * @param string $trackingUrl
     */
    public function __construct(string $postCode, string $postStatusName, string $trackingUrl)
    {
        $this->postCode = $postCode;
        $this->postStatusName = $postStatusName;
        $this->trackingUrl = $trackingUrl;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->postCode;
    }

    /**
     * @return string
     */
    public function getPostStatusName(): string
    {
        return $this->postStatusName;
    }

    /**
     * @return string
     */
    public function getTrackingUrl(): string
    {
        return $this->trackingUrl;
    }
}