<?php

namespace Anan\Oss;

use Anan\Oss\Support\Config;
use Anan\Oss\Support\HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;
use \SplFileInfo;


class OssClient
{
    private SplFileInfo $file;

    /**
     * 普通上传文件
     *
     * @param string $filePath 需要上传的文件路径。
     * @param string $fileName 上传后的文件名，为空会随机生成。
     * @return string OSS URL
     * @throws GuzzleException
     */
    public function uploadFile(string $filePath, String $fileName = ''): string
    {
        $this->file = new SplFileInfo($filePath);

        if ($this->file->isFile()) {
            $http = new HttpClient();
            return $http->put($filePath, $this->getFileName($fileName));
        }

    }


    private function getFileName(string $fileName): string
    {
        $fileName = empty($fileName) ? Str::random(10). '.' . $this->file->getExtension() : $fileName;

        return Str::start($fileName, '/');
    }
}