<?php

namespace Hillpy\PHPTools;

include "Common.php";

/**
 * Class Prize
 * @package Hillpy\PHPTools
 */
class Prize
{
    // 抽奖球总数
    const TOTAL = 1000;
    // 获取奖球数量
    const GET_NUM = 1;
    // 抽奖类型
    private $type = 'box';
    // 抽奖数据
    private $data = array();
    // 默认抽奖数据
    private $defaultData = array(
        'name' => '',
        'amount' => 0,
        '_amount' => 0,
        'prob' => 0
    );
    // 抽奖配置
    private $config = array();
    // 默认抽奖配置
    private $configArr = array(
        'box' => array(
            'total' => self::TOTAL,
            'get_num' => self::GET_NUM
        )
    );

    // 实例
    private static $instance;

    /**
     * 获取实例
     *
     * @return Prize
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Prize constructor.
     */
    private function __construct()
    {
    }

    /**
     * Prize clone
     */
    private function __clone()
    {
    }

    /**
     * 设置抽奖类型
     *
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * 获取抽奖类型
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * 设置抽奖数据
     *
     * @param $data
     * @return $this
     */
    public function setData($data)
    {
        if (is_array($data)) {
            foreach ($data as $value) {
                $this->data[] = Common::updateArrayData($this->defaultData, $value);
            }
        }
        return $this;
    }

    /**
     * 获取抽奖数据
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * 设置抽奖配置
     *
     * @param $config
     * @return $this
     */
    public function setConfig($config)
    {
        $this->config = Common::updateArrayData($this->configArr[$this->type], $config);

        return $this;
    }

    /**
     * 获取抽奖配置
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * 获取抽奖结果（即执行抽奖）
     *
     * @return array
     */
    public function getPrize()
    {
        if ($this->type === 'box') {
            $box = $this->beforePrize();
            shuffle($box);
            $boxKey = array_rand($box, isset($this->config['get_num']) ? $this->config['get_num'] : self::GET_NUM);

            $res = array();
            if (is_array($boxKey)) {
                foreach ($boxKey as $value) {
                    $dataKey = $box[$value];
                    if (
                        $dataKey >= 0 &&
                        $this->data[$dataKey]['amount'] > 0 &&
                        $this->data[$dataKey]['amount'] > $this->data[$dataKey]['_amount']
                    ) {
                        // 此奖品中奖数+1
                        $this->data[$dataKey]['_amount']++;

                        $arr['key'] = $dataKey;
                        $arr['name'] = $this->data[$dataKey]['name'];
                        $arr['amount'] = $this->data[$dataKey]['amount'];
                        $arr['_amount'] = $this->data[$dataKey]['_amount'];
                    } else {
                        $arr['key'] = -1;
                        $arr['name'] = '';
                        $arr['amount'] = 0;
                        $arr['_amount'] = 0;
                    }

                    $res[] = $arr;
                }
            } else {
                $dataKey = $box[$boxKey];
                if (
                    $dataKey >= 0 &&
                    $this->data[$dataKey]['amount'] > 0 &&
                    $this->data[$dataKey]['amount'] > $this->data[$dataKey]['_amount']
                ) {
                    $this->data[$dataKey]['_amount']++;

                    $arr['key'] = $dataKey;
                    $arr['name'] = $this->data[$dataKey]['name'];
                    $arr['amount'] = $this->data[$dataKey]['amount'];
                    $arr['_amount'] = $this->data[$dataKey]['_amount'];

                } else {
                    $arr['key'] = -1;
                    $arr['name'] = '';
                    $arr['amount'] = 0;
                    $arr['_amount'] = 0;
                }

                $res = $arr;
            }

            return $res;
        }
    }

    /**
     * 抽奖前的准备工作
     *
     * @return array
     */
    private function beforePrize()
    {
        if ($this->type === 'box') {
            $box = array();
            $total = isset($this->config['total']) ? $this->config['total'] : self::TOTAL;
            $remain = $total;
            foreach ($this->data as $key => $value) {
                if (
                    $value['name'] != '' &&
                    $value['amount'] > $value['_amount'] &&
                    is_numeric($value['prob']) &&
                    $value['prob'] > 0
                ) {
                    for ($i = 0; $i < $value['prob']; $i++) {
                        $box[] = $key;
                    }
                    $remain -= $value['prob'];
                }
            }

            for ($i = 0; $i < $remain; $i++) {
                $box[] = -1;
            }

            return $box;
        }
    }
}