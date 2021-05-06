<?php

namespace Aries\Oss;

use Aries\Oss\Support\Config;
use Aries\Oss\Support\HttpClient;


class OssClient
{

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function uploadFile(string $filePath): string
    {
        $http = new HttpClient();
        return $http->put($filePath);
    }
}