<h1 align="center"> EasyOSS </h1>

<p align="center"> 支持 PHP8 </p>

## Description
准备在一个小项目中试用 laravel/octane ，这就需要把 PHP 版本升级到8，升级后其他功能都没问题，突然发现阿里云OSS的图片上传失败了，后来才发现去年就有这个问题，但是阿里云官方一直没有更新SDK，而其他包基本都是基于阿里云SDK做的封装。

为了体验 octane 只能临时写个模块了，只完成了基本功能，还不成熟。

## Installing

```shell
$ composer require anan/oss -vvv
```

## Usage
- 发布 OSS 配置文件

    `php artisan vendor:publish --tag=easyOss.config`


- 目前只支持普通模式上传文件，并返回 OSS 地址
    ```phpt
    <?php
    use Anan\Oss\Facades\EasyOss;
    // 随机生成文件名
    $ossUrl = EasyOss::uploadFile('/tmp/logo.jpg');
    
    // 指定文件夹名称，文件名随机生成
    $ossUrl = EasyOss::uploadFile('/tmp/logo.jpg', 'store');
    
    // 指定文件名
    $ossUrl = EasyOss::uploadFile('/tmp/logo.jpg', 'new-logo.jpg');
    
    // 指定完整文件名
    $ossUrl = EasyOss::uploadFile('/tmp/logo.jpg', 'logo/new-logo.jpg');
    
    ```


## License

MIT