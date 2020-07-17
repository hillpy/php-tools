<?php

use PHPUnit\Framework\TestCase;
use Hillpy\PHPTools\Str\Str;

class StrTest extends TestCase
{
    public function testGetNonce()
    {
        var_dump('=====================');
        for ($i = 0; $i < 100; $i++) {
            $nonce = Str::getNonce();
            var_dump($nonce);
        }
    }

    public function testGetNonceByURandom()
    {
        var_dump('=====================');
        for ($i = 0; $i < 100; $i++) {
            $nonce = Str::getNonceByURandom();
            var_dump($nonce);
        }
    }
}
