<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\AopService;

//保存日志于文本中
class TextService implements AopInterface
{
    public function before(...$arguments){}

    public function after(...$arguments)
    {
        $this->save(sprintf("[text] [after] %s", $arguments[0]??''));
    }

    private function save(string $message)
    {
        if (!is_dir('./log')) {
            mkdir('./log',0755);
        }
        $message = sprintf("%s==>%s%s", date("Y-m-d H:i:s"), $message, PHP_EOL);

        file_put_contents(
            sprintf('./log/%s.log', date("Ymd")),
            $message,
            FILE_APPEND
        );
    }
}