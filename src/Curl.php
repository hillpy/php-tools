<?php

namespace Hillpy\PHPTools;

/**
 * Class Curl
 * @package Hillpy\PHPTools
 */
class Curl
{
    /**
     * 简易get请求
     *
     * @param $url
     * @return mixed
     */
    public static function get($url)
    {
        $curl = curl_init();
        $optionArr = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($curl, $optionArr);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }

    /**
     * 简易post请求
     * @param $url
     * @param $data
     * @return mixed
     */
    public static function post($url, $data)
    {
        $curl = curl_init();
        $optionArr = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data
        );
        curl_setopt_array($curl, $optionArr);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
}
