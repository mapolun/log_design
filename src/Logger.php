<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign;

//日志服务
//实现记录日志后同时存储本地文件和meilisearch服务
class Logger
{
    public function info(string $message)
    {
        echo "logger [info] {$message}" . PHP_EOL;
    }

    public function error(string $message)
    {
        echo "logger [error] {$message}" . PHP_EOL;
    }

    public function debug(string $message)
    {
        echo "logger [debug] {$message}" . PHP_EOL;
    }

    public function waring(string $message)
    {
        echo "logger [waring] {$message}" . PHP_EOL;
    }

    public function notice(string $message)
    {
        echo "logger [notice] {$message}" . PHP_EOL;
    }
}