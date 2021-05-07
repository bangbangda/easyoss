<?php
namespace Anan\Oss\Traits;

use GuzzleHttp\Client;

trait OssTrait
{

    public function getHttpClient(): Client
    {
        return new Client([
            // Base URI is used with relative requests
            'base_uri' => $this->getOssHost(true),
            // You can set any number of default request options.
            'timeout'  => 3.0,
        ]);
    }

    public function getOssHost(bool $isHttp = false): string
    {
        $http = '';
        if ($isHttp) {
            $http = 'https://';
        }
        return $http . config('alioss.defaultBucket'). '.' .config('alioss.endpoint');
    }

    public function signature(array $headers, string $fileName): string
    {
        uksort($headers, 'strnatcasecmp');

        $stringSign = "PUT\n\n";

        foreach ($headers as $header_key => $value) {
            if (
                strtolower($header_key) === 'content-md5' ||
                strtolower($header_key) === 'content-type' ||
                strtolower($header_key) === 'date'
            ) {
                $stringSign .= $value . "\n";
            }
        }

        $stringSign .= '/'.config('alioss.defaultBucket').'/'.$fileName;

        return base64_encode(hash_hmac('sha1', $stringSign, config('alioss.accessKeySecret'), true));
    }


    public function getAuthorization(array $headers, string $fileName): string
    {
        return 'OSS ' . config('alioss.accessKeyId') . ':' . $this->signature($headers, $fileName);;
    }

}