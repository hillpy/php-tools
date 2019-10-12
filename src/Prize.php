<?php

namespace hillpy\phptools;
include "Common.php";

class Prize
{
    const TOTAL = 1000;
    const GET_NUM = 1;

    private $type = 'box';

    private $data = array();

    private $defaultData = array(
        'name' => '',
        'amount' => 0,
        '_amount' => 0,
        'prob' => 0
    );

    private $config = array();

    private $configArr = array(
        'box' => array(
            'total' => self::TOTAL,
            'get_num' => self::GET_NUM
        )
    );

    private static $instance;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setData($data)
    {
        if (is_array($data)) {
            foreach ($data as $value) {
                $this->data[] = Common::updateArrayData($this->defaultData, $value);
            }
        }
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setConfig($config)
    {
        $this->config = Common::updateArrayData($this->configArr[$this->type], $config);

        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getPrize()
    {
        if ($this->type === 'box') {
            $box = $this->beforePrize();
            shuffle($box);
            $boxKey =array_rand($box, isset($this->config['get_num']) ? $this->config['get_num'] : self::GET_NUM);

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