<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\AopService;

class TextService implements AopInterface
{
    public function before()
    {
        echo "[text] [before]" . PHP_EOL;
    }

    public function after()
    {
        echo "[text] [after]" . PHP_EOL;
    }
}