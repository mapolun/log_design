<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

require './vendor/autoload.php';

use LoggerDesign\AopService\MeiliSearchService;
use LoggerDesign\AopService\TextService;
use LoggerDesign\Library\Containers;
use LoggerDesign\Logger;
use LoggerDesign\Proxy\LoggerProxy;

$logger = getLogger();
$logger->info("测试");

function getLogger() : LoggerProxy
{
    try{

        //代理注入logger类
        $logger = new LoggerProxy(Logger::class);

        //设置logger后置服务，切面
        $convertors = getAfterGroup();
        $logger->setConvertors($convertors);

        return $logger;
    }catch (Exception $exception) {
        echo $exception->getMessage() . PHP_EOL;die;
    }
}

/**
 * @throws ReflectionException
 */
function getAfterGroup() : array
{
    $containers = new Containers();
    //加载textService
    $containers->add("text",TextService::class);
    //价值meilisearchService
    $containers->add("meilisearch",MeiliSearchService::class);
    return $containers->get();
}
