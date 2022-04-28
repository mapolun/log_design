<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Engine;

use LoggerDesign\Engine\Repository\BaseEngine;

class TextEngine extends BaseEngine
{
    public static function save($data)
    {
        if (!$data) {
            return;
        }

        $config = self::getConfig('text');
        if (is_array($data)) {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        if (!is_dir($config['dir'])) {
            mkdir($config['dir'],0755);
        }
        $message = sprintf("%s==>%s%s", date("Y-m-d H:i:s"), $data, PHP_EOL);

        file_put_contents(
            sprintf('%s/%s.log', $config['dir'], date("Ymd")),
            $message,
            FILE_APPEND
        );
    }
}