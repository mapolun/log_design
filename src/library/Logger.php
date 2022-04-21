<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Library;

//日志服务
//实现记录日志后同时存储本地文件和meilisearch服务
class Logger
{
    public function info(string $message)
    {
        $this->console($message, 'info');
    }

    public function error(string $message)
    {
        $this->console($message, 'error');
    }

    public function debug(string $message)
    {
        $this->console($message, 'debug');
    }

    public function waring(string $message)
    {
        $this->console($message, 'waring');
    }

    public function notice(string $message)
    {
        $this->console($message, 'notice');
    }

    public function console(string $message, string $level)
    {
        echo "logger [{$level}] {$message}" . PHP_EOL;
    }
}