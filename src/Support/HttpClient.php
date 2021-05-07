<?php

namespace Anan\Oss\Support;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Support\Str;
use Anan\Oss\Traits\OssTrait;

class HttpClient
{

    use OssTrait;

    /**
     * @throws \Exception|GuzzleException
     */
    public function put(string $filePath, String $fileName = ''): string
    {
        $file = new \SplFileInfo($filePath);

        $headers = [
            'User-Agent' => 'QyHttp',
            'Content-Type' => MimeTypes::get($file->getExtension()),
            'Date' => gmdate('D, d M Y H:i:s \G\M\T'),
            'Host' => $this->getOssHost(),
            'Authorization' => 'OSS '.config('alioss.accessKeyId').':ffMmsvnEJHeUmzQVGoVJsAweWHs='
        ];

        $fileName = empty($fileName) ? Str::random(10). '.' . $file->getExtension() : $fileName;

        $headers['Authorization'] = $this->getAuthorization($headers, $fileName);

        $result = $this->getHttpClient()->put('activity/' . $fileName, [
            'body' =>  Utils::tryFopen($filePath, 'r'),
            'headers' => $headers
        ]);

        if ($result->getStatusCode() == 200) {
            return $this->getOssHost(true) . "/activity/$fileName";
        } else {
            throw new \Exception('Oss 上传失败');
        }
    }

}