<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Hook;


use LoggerDesign\Engine\RedisEngine;
use LoggerDesign\Hook\Repository\HookInterface;

class Redis implements HookInterface
{
    public function before(...$arguments){}

    public function after(...$arguments)
    {
        list($level, $message) = $arguments;
        $message = sprintf("[%s] [after] %s", $level, $message);
        $engine = new RedisEngine();
        $redis = $engine->getEngine();
        $index = "z:log:" . date("Ym") .":". date("d");
        $redis->zAdd($index, time(), $message);
    }
}