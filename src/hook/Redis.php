<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Hook;


use LoggerDesign\Hook\Repository\HookInterface;
use \LoggerDesign\Engine\Redis as RedisEngine;

class Redis implements HookInterface
{
    public function before(...$arguments){}

    public function after(...$arguments)
    {
        list($level, $message) = $arguments;
        $message = sprintf("[%s] [after] %s", $level, $message);
        RedisEngine::create()->setData($message)->save();
    }
}