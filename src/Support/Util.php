<?php


namespace Aries\Oss\Support;


use Illuminate\Support\Str;

class Util
{

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

        $string_to_sign_ordered = "PUT\n\n";

        foreach ($headers as $header_key => $value) {
            if (
                strtolower($header_key) === 'content-md5' ||
                strtolower($header_key) === 'content-type' ||
                strtolower($header_key) === 'date'
            ) {
                $string_to_sign_ordered .= $value . "\n";
            }
        }

        $string_to_sign_ordered .= '/'.config('alioss.defaultBucket').'/activity/'.$fileName;

        return base64_encode(hash_hmac('sha1', $string_to_sign_ordered, config('alioss.accessKeySecret'), true));
    }

    public function getAuthorization(array $headers, string $fileName): string
    {
        return 'OSS ' . config('alioss.accessKeyId') . ':' . $this->signature($headers, $fileName);;
    }
}