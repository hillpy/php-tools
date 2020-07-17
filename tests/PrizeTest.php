<?php

use PHPUnit\Framework\TestCase;
use Hillpy\PHPTools\Prize\Prize;

class PrizeTest extends TestCase
{
    public function testPrize()
    {
        $Prize = Prize::getInstance();
        $data = array(
            array(
                'name' => 'macbook pro',
                'amount' => 5,
                '_amount' => 0,
                'prob' => 100
            ),
            array(
                'name' => 'hhkb',
                'amount' => 50,
                '_amount' => 0,
                'prob' => 200
            ),
            array(
                'name' => 'js红皮书',
                'amount' => 200,
                '_amount' => 0,
                'prob' => 400
            )
        );
        $noPrizeResData = array(
            'name' => '未中奖',
            'count' => 0
        );
        $resData = array(
            array(
                'name' => 'macbook pro',
                'count' => 0
            ),
            array(
                'name' => 'hhkb',
                'count' => 0
            ),
            array(
                'name' => 'js红皮书',
                'count' => 0
            )
        );
        $Prize->setData($data);
        for ($i = 0; $i < 100; $i++) {
            $res = $Prize->getPrize();
            if ($res['key'] >= 0) {
                $resData[$res['key']]['count']++;
            } else {
                $noPrizeResData['count']++;
            }
        }
        array_unshift($resData, $noPrizeResData);
        var_dump($resData);
    }
}
