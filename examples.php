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
$logger->info("123");

function getLogger() : LoggerProxy
{
    try{

        $logger = new LoggerProxy(Logger::class);

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
    $containers->add("text",TextService::class);
    $containers->add("meilisearch",MeiliSearchService::class);
    return $containers->get();
}
