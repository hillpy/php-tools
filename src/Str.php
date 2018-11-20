<?php

namespace hillpy\phptools;

class Str
{
    /**
     * 获取字符串
     * @param int $length
     */
    public static function getNonce($type = 1, $length = 16)
    {
        $nonce = '';
        switch ($type) {
            case 1:
                $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                break;
            case 2:
                $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 3:
                $string = '0123456789';
                break;
            default:
                $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        }
        for ($i = 0; $i < $length; $i++) {
            $nonce .= substr($string, mt_rand(0, strlen($string) - 1), 1);
        }
        return $nonce;
    }
}