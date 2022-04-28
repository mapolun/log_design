<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Hook;


use LoggerDesign\Engine\MysqlEngine;
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

        $engine = new MysqlEngine();
        $db = $engine->getEngine();
        $db->insert("log", [
            'data_json' => json_encode(['message'=>$message], JSON_UNESCAPED_UNICODE),
            'create_time' => time(),
        ]);
    }
}