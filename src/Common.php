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

    /**
     * 更新原数组的数据（仅更新原数组已有的键）
     * @param $rawData
     * @param $newData
     * @return array
     */
    public static function updateArrayData($rawData, $newData)
    {
        if (!is_array($rawData) || count($rawData) <= 0) {
            return array();
        }
        if (!is_array($newData)) {
            return $rawData;
        }
        foreach ($rawData as $key => $value) {
            isset($newData[$key]) && $rawData[$key] = $newData[$key];
        }
        return $rawData;
    }
}