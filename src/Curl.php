<?php

namespace hillpy\phptools;

class Curl
{
    /**
     * 简易get请求
     * @param $url
     * @return mixed
     */
    public static function get($url)
    {
        $curl = curl_init();
        $optionArr = array(
            CURLOPT_URL=>$url,
            CURLOPT_HEADER=>false,
            CURLOPT_RETURNTRANSFER=>true
        );
        curl_setopt_array($curl, $optionArr);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
}