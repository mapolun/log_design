<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\AopService;

class MeiliSearchService implements AopInterface
{
    public function before()
    {
        echo "[meilisearch] [before]" . PHP_EOL;
    }

    public function after()
    {
        echo "[meilisearch] [after]" . PHP_EOL;
    }
}