<?php

namespace Aries\Oss\Support;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Support\Str;

class HttpClient
{
    private Client $client;

    private \SplFileInfo $file;

    public function __construct()
    {

        $this->client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://vision-image.oss-cn-shanghai.aliyuncs.com/',
            // You can set any number of default request options.
            'timeout'  => 3.0,
        ]);
    }


    /**
     * @throws \Exception|\GuzzleHttp\Exception\GuzzleException
     */
    public function put(string $filePath, String $fileName = ''): string
    {
        $this->file = new \SplFileInfo($filePath);
        $util = new Util();

        $headers = [
            'User-Agent' => 'QyHttp',
            'Content-Type' => MimeTypes::get($this->file->getExtension()),
            'Date' => gmdate('D, d M Y H:i:s \G\M\T'),
            'Host' => $util->getOssHost(),
            'Authorization' => 'OSS '.config('alioss.accessKeyId').':ffMmsvnEJHeUmzQVGoVJsAweWHs='
        ];

        $fileName = empty($fileName) ? Str::random(10). '.' . $this->file->getExtension() : $fileName;

        $headers['Authorization'] = $util->getAuthorization($headers, $fileName);

        $result = $this->client->put('activity/' . $fileName, [
            'body' =>  Utils::tryFopen($filePath, 'r'),
            'headers' => $headers
        ]);

        if ($result->getStatusCode() == 200) {
            return $util->getOssHost(true) . "/activity/$fileName";
        } else {
            throw new \Exception('Oss 上传失败');
        }
    }
}