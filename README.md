<h1 align="center"> oss </h1>

<p align="center"> 阿里云OSS，支持 PHP8 。</p>


## Installing

```shell
$ composer require anan/oss -vvv
```

## Usage
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