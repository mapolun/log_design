<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Engine;

use LoggerDesign\Engine\Repository\BaseEngine;
use LoggerDesign\Engine\Repository\EngineInterface;

class RedisEngine extends BaseEngine implements EngineInterface
{
    public function __construct(array $options = [])
    {
        parent::__construct();
        if (!isset($options['select']) || !$options['select']) {
            $options['select'] = "master";
        }

        $redis = new \Redis();
        $redis->connect($this->config[$options['select']]['host'], $this->config[$options['select']]['port']);
        if ($this->config[$options['select']]['auth']) {
            $redis->auth($this->config[$options['select']]['auth']);
        }
        if ($this->config[$options['select']]['select']) {
            $redis->select($this->config[$options['select']]['select']);
        }
        $this->engine = $redis;
    }

    public function getEngine() : \Redis
    {
        return $this->engine;
    }

    public function select(int $select) : \Redis
    {
        $this->engine->select($select);
        return $this->engine;
    }
}