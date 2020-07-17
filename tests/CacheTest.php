<?php

use PHPUnit\Framework\TestCase;
use Hillpy\PHPTools\Cache\Cache;

class CacheTest extends TestCase
{
    public function testFile()
    {
        $cacheOption = [
          'driver' => 'file',
        ];
        $cache = Cache::getInstance($cacheOption);
        print_r($cache);
        print_r($cache->set('name', 'shinn_lancelot', 300));
        print_r($cache->get('name'));
        print_r($cache->delete('name'));
        print_r($cache->clear());
    }

    public function testRedis()
    {
        $cacheOption = [
          'driver' => 'redis',
        ];
        $cache = Cache::getInstance($cacheOption);
        print_r($cache);
        print_r($cache->set('name', 'saint', 300));
        print_r($cache->get('name'));
        print_r($cache->delete('name'));
        print_r($cache->clear());
    }

    public function testMemcached()
    {
        $cacheOption = [
          'driver' => 'memcached',
        ];
        $cache = Cache::getInstance($cacheOption);
        print_r($cache);
        print_r($cache->set('name', 'shinn0317', 300));
        print_r($cache->get('name'));
        print_r($cache->delete('name'));
        print_r($cache->clear());
    }
}
