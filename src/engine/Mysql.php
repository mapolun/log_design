<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Engine;


use LoggerDesign\Engine\Repository\BaseEngine;
use LoggerDesign\Engine\Repository\EngineInterface;
use Medoo\Medoo;
use Yosymfony\Toml\Toml;

class Mysql extends BaseEngine implements EngineInterface
{
    public function save()
    {
        if (!$this->data) {
            return;
        }
        $db = $this->getDb();
        $db->insert("log", [
            'data_json' => json_encode(['message'=>$this->data], JSON_UNESCAPED_UNICODE),
            'create_time' => time(),
        ]);
    }

    private function getDb() : Medoo
    {
        $config = Toml::parseFile('./config.toml')['mysql'];
        return new medoo([
            'database_type' => 'mysql',
            'database_name' => $config['database'],
            'server' => $config['host'],
            'username' => $config['userName'],
            'password' => $config['password'],
            'port' => $config['port'],
            'charset' => 'utf8'
        ]);
    }
}