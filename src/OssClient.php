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

    /**
     * 处理自定义目录、文件名
     *
     * @param string $fileName
     * @return string
     */
    private function getFileName(string $fileName): string
    {
        if (empty($fileName)) {
            $fileName = $this->getRandomName();
        } else if (! Str::contains($fileName, '.')) {
            $fileName = Str::finish($fileName, '/') . $this->getRandomName();
        }

        return Str::start($fileName, '/');
    }

    private function getRandomName(): string
    {
        return Str::random(10). '.' . $this->file->getExtension();
    }
}