<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Library;

use LoggerDesign\Hook\MeiLiSearchHook;
use LoggerDesign\Hook\MongoDbHook;
use LoggerDesign\Hook\MysqlHook;
use LoggerDesign\Hook\RedisHook;
use LoggerDesign\Hook\TextHook;

class Engine
{
    protected static array $engines = [
        'text' => TextHook::class,
        'meilisearch' => MeiLiSearchHook::class,
        'mysql' => MysqlHook::class,
        'redis' => RedisHook::class,
        'mongodb' => MongoDbHook::class,
    ];

    public static function get(string $name)
    {
        return self::$engines[$name] ?? "";
    }
}