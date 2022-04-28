<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\Engine;

use LoggerDesign\Engine\Repository\BaseEngine;
use LoggerDesign\Engine\Repository\EngineInterface;
use MeiliSearch\Client;
use MeiliSearch\Exceptions\CommunicationException;
use Yosymfony\Toml\Toml;

class MeiLiSearchEngine extends BaseEngine
{
    public function __construct(array $options = [])
    {
        parent::__construct();
        $this->engine = new Client(sprintf("http://%s:%s", $this->config['host'], $this->config['port']),$this->config['key']);
    }

    public function getEngine() : Client
    {
        return $this->engine;
    }
}