<?php

use PHPUnit\Framework\TestCase;
use hillpy\phptools\Curl;

class CurlTest extends TestCase
{
    public function testGet()
    {
        $url = "https://www.baidu.com";
        $res = Curl::get($url);
        $arr = json_decode($res, true);
        var_dump($arr);
    }
}