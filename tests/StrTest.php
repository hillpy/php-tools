<?php

use PHPUnit\Framework\TestCase;
use hillpy\phptools\Str;

class StrTest extends TestCase
{
    public function testGetStr()
    {
        for ($i = 0; $i < 100; $i++) {
            $nonce = Str::getNonce();
            var_dump($nonce);
        }
    }
}