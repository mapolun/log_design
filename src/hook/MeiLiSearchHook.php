<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\Hook;

//保存日志于meilisearch中
use LoggerDesign\Hook\Repository\HookInterface;
use LoggerDesign\Engine\MeiLiSearch;

class MeiLiSearchHook implements HookInterface
{
    public function before(...$arguments){}

    public function after(...$arguments)
    {
        list($level, $message) = $arguments;
        $message = sprintf("[%s] [after] %s", $level, $message);
        MeiLiSearch::create()->setData($message)->save();
    }
}