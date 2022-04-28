<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Engine;


use LoggerDesign\Engine\Repository\BaseEngine;
use LoggerDesign\Engine\Repository\EngineInterface;
use Medoo\Medoo;

class MysqlEngine extends BaseEngine implements EngineInterface
{
    public function __construct(array $options = [])
    {
        parent::__construct();
        if (!isset($options['select']) || !$options['select']) {
            $options['select'] = "master";
        }

        $this->engine = new medoo([
            'database_type' => 'mysql',
            'database_name' => $this->config[$options['select']]['database'],
            'server' => $this->config[$options['select']]['host'],
            'username' => $this->config[$options['select']]['userName'],
            'password' => $this->config[$options['select']]['password'],
            'port' => $this->config[$options['select']]['port'],
            'charset' => 'utf8'
        ]);
    }

    public function getEngine() : Medoo
    {
        return $this->engine;
    }
}