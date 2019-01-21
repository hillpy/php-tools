<?php

namespace hillpy\phptools;

class Common
{
    /**
     * 是否为windows系统
     * @return bool
     */
    public static function isWin()
    {
        if (strtolower(substr(PHP_OS,0,3)) === 'win') {
            return true;
        } else {
            return false;
        }
    }
}