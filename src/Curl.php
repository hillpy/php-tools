<?php

namespace hillpy\phptools;

class Curl extends Base
{
    public static function get($url)
    {
        $curl = curl_init();
        $optionArr = array(
            CURLOPT_URL=>$url,
            CURLOPT_HEADER=>true,
            CURLOPT_RETURNTRANSFER=>true
        );
        curl_setopt_array($curl, $optionArr);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
}