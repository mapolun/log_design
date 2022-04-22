<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Engine;

use LoggerDesign\Engine\Repository\BaseEngine;
use LoggerDesign\Engine\Repository\EngineInterface;
use Yosymfony\Toml\Toml;

class Redis extends BaseEngine implements EngineInterface
{
    public function save()
    {
        if (!$this->data) {
            return;
        }
        $redis = $this->getDb();
        $data = $this->data;
        $index = "z:log:" . date("Ym") .":". date("d");
        $redis->zAdd($index, time(), $data);
    }

    private function getDb() : \Redis
    {
        $config = Toml::parseFile('./config.toml')['redis'];
        $redis = new \Redis();
        $redis->connect($config['host'], $config['port']);
        if ($config['auth']) {
            $redis->auth($config['auth']);
        }

        return $redis;
    }
}