<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\Hook;

//保存日志于文本中
use LoggerDesign\Hook\Repository\HookInterface;
use LoggerDesign\Engine\Text;

class TextHook implements HookInterface
{
    public function before(...$arguments){}

    public function after(...$arguments)
    {
        list($level, $message) = $arguments;
        $data = sprintf("[%s] [after] %s", $level, $message);
        Text::create()->setData($data)->save();
    }
}