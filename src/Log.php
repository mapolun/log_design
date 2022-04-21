<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign;

use LoggerDesign\Hook\MeiLiSearchHook;
use LoggerDesign\Hook\TextHook;
use LoggerDesign\Library\Containers;
use LoggerDesign\Library\Engine;
use LoggerDesign\Library\LogException;
use LoggerDesign\Library\Logger;
use LoggerDesign\Proxy\LoggerProxy;
use Yosymfony\Toml\Toml;

class Log
{
    /**
     * @throws LogException
     */
    public static function new() : LoggerProxy
    {
        try{

            //代理注入logger类
            $logger = new LoggerProxy(Logger::class);

            //设置logger后置服务，切面
            $convertors = self::getEngineConvertors();
            $logger->setConvertors($convertors);

            return $logger;
        }catch (\Exception $exception) {
            throw new LogException($exception->getMessage());
        }
    }

    /**
     * @throws \ReflectionException
     */
    private static function getEngineConvertors() : array
    {
        $containers = new Containers();

        $config = Toml::parseFile('./config.toml');
        if (!$config['engine']) {
            throw new \Exception("未选择存储引擎");
        }

        //存储引擎
        foreach ($config['engine'] as $name) {
            $engine = Engine::get($name);
            if (empty($engine)) {
                throw new \Exception("{$engine} 存储引擎不存在");
            }
            $containers->add($name, $engine);
        }
        return $containers->get();
    }
}