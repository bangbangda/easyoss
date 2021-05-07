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

$ossUrl = EasyOss::uploadFile('/tmp/logo.jpg');

```


## License

MIT