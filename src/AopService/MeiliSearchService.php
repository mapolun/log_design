<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\AopService;

//保存日志于meilisearch中
class MeiliSearchService implements AopInterface
{
    public function before(...$arguments){}

    public function after(...$arguments)
    {
        $this->save(sprintf("[meilisearch] [after] %s", $arguments[0]??''));
    }

    private function save(string $message, bool $write = true)
    {
        $message = sprintf("%s==>%s%s", date("Y-m-d H:i:s"), $message, PHP_EOL);

        if (!$write) {
            echo $message;
        }
    }
}