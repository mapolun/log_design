<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Library;

use LoggerDesign\Hook\MeiLiSearch;
use LoggerDesign\Hook\MongoDb;
use LoggerDesign\Hook\Mysql;
use LoggerDesign\Hook\Redis;
use LoggerDesign\Hook\Text;

class Engine
{
    protected static array $engines = [
        'text' => Text::class,
        'meilisearch' => MeiLiSearch::class,
        'mysql' => Mysql::class,
        'redis' => Redis::class,
        'mongodb' => MongoDb::class,
    ];

    public static function get(string $name)
    {
        return self::$engines[$name] ?? "";
    }
}