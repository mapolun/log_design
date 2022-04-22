<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Hook;


use LoggerDesign\Engine\Mysql as MysqlEngine;
use LoggerDesign\Hook\Repository\HookInterface;

class Mysql implements HookInterface
{
    public function before(...$arguments)
    {
        // TODO: Implement before() method.
    }
    public function after(...$arguments)
    {
        list($level, $message) = $arguments;
        $message = sprintf("[%s] [after] %s", $level, $message);
        MysqlEngine::create()->setData($message)->save();
    }
}