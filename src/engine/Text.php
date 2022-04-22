<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Engine;

use LoggerDesign\Engine\Repository\BaseEngine;
use LoggerDesign\Engine\Repository\EngineInterface;

class Text extends BaseEngine implements EngineInterface
{
    public function save()
    {
        $data = $this->data;
        if (!$data) {
            return;
        }

        if (is_array($data)) {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        if (!is_dir('./log')) {
            mkdir('./log',0755);
        }
        $message = sprintf("%s==>%s%s", date("Y-m-d H:i:s"), $data, PHP_EOL);

        file_put_contents(
            sprintf('./log/%s.log', date("Ymd")),
            $message,
            FILE_APPEND
        );
    }
}