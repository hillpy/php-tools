<?php

use PHPUnit\Framework\TestCase;
use Hillpy\PHPTools\Common;

class CommonTest extends TestCase
{
    public function testIsWin()
    {
        var_dump('isWin: ' . (Common::isWin() ? 'Yes' : 'No'));
    }

    public function testUpdateArrayData()
    {
        $defaultArr = array(
            'name' => '',
            'sex' => '',
            'other' => array(
                'age' => 18,
                'country' => 'China',
                'hobby' => array(
                    'anime',
                    'game',
                    'music'
                )
            )
        );
        $newArr = array(
            'name' => 'shinn_lancelot',
            'sex' => 'male',
            'other' => array(
                'age' => 28,
                'hobby' => array(
                    'comic'
                )
            )
        );

        var_dump(Common::updateArrayData($defaultArr, $newArr));
    }
}
