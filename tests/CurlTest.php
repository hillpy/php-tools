<?php

use PHPUnit\Framework\TestCase;
use Hillpy\PHPTools\Curl;

class CurlTest extends TestCase
{
    public function testGet()
    {
        $url = 'https://www.baidu.com';
        $res = Curl::get($url);
        var_dump($res);
    }

    public function testPost()
    {
        $url = '';
        $dataArr[''] = '';
        $res = Curl::post($url, json_encode($dataArr));
        $resArr = json_decode($res, true);
        var_dump($resArr);
    }
}
