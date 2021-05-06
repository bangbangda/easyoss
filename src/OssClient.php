<?php

namespace Anan\Oss;

use Anan\Oss\Support\Config;
use Anan\Oss\Support\HttpClient;


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