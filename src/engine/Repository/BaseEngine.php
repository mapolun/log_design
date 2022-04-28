<?php
/**
 * Author mapo
 * Date   2022/4/27
 */

namespace LoggerDesign\Engine\Repository;


use Yosymfony\Toml\Toml;

class BaseEngine
{
    protected $engine;

    protected array $config;

    public function __construct()
    {
        $class = get_called_class();
        $end = explode('\\', $class);
        $engine = strtolower(strstr(end($end),"Engine", true));
        $this->config = self::getConfig($engine);
    }

    protected static function getConfig(string $engine) : array
    {
        $configs = Toml::parseFile('./config.toml');
        return $configs[$engine] ?? [];
    }

    public static function create(): static
    {
        return new static();
    }
}