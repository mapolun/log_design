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

class MeiLiSearch extends BaseEngine implements EngineInterface
{
    const INDEX = 'log';

    protected Client $client;

    public function save()
    {
        $data = $this->data;
        if (!$data) {
            return true;
        }
        $this->client = $this->getDb();
        $index = $this->client->index(self::INDEX);
        //设置排序
        $this->setSort();
        //获取文档中最后一个id
        $count = $index->search(null)->getHitsCount();
        if ($count == 0) {
            $id = 1;
        } else {
            $id = ($index->search(null, ['offset'=>$count-1])->getHit(0)['id'] ?? 0)+1;
        }

        $document = array(
            'id' => $id,
            'message' => $data,
            'time' => date("Y-md H:i:s")
        );
        $index->addDocuments($document);
        return true;
    }

    private function getDb()
    {
        try {
            $config = Toml::parseFile("./config.toml")['meiLiSearch'];
            return new Client(sprintf("http://%s:%s", $config['host'], $config['port']),$config['key']);
        }catch (CommunicationException $communicationException) {
            echo $communicationException->getMessage() . PHP_EOL;die;
        }catch (\Exception $exception) {
            echo $exception->getMessage() . PHP_EOL;die;
        }
    }

    private function getLogs()
    {
        $page = 1;
        $limit = 20;
        $offset = ($page-1)*$limit;


        $client = $this->getDb();
        $index = $client->index(self::INDEX);
        $list = $index->search(null, ['offset'=>$offset, 'limit'=>$limit, 'sort'=>['id:desc']])->getHits();
        var_dump($list);die;
    }

    private function setSort()
    {
        $index = $this->client->index(self::INDEX);
        //加入id,time排序规则
        $sortables = $index->getSortableAttributes();
        if (!in_array('id', $sortables) || !in_array('time', $sortables)) {
            $index->updateSortableAttributes(array_merge_recursive($sortables, ['id','time']));
            //meiliseach为异步执行更新排序属性，需对本次请求的生命周期sleep 2s
            sleep(2);
        }
    }
}