<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\Hook;

//保存日志于meilisearch中
use LoggerDesign\Hook\Repository\HookInterface;
use LoggerDesign\Engine\MeiLiSearchEngine as MeiLiSearchEngine;
use MeiliSearch\Client;

class MeiLiSearch implements HookInterface
{
    const INDEX = 'log';

    protected Client $client;

    public function before(...$arguments){
//        $logs = $this->getLogs();
//        var_dump($logs);
    }

    public function after(...$arguments)
    {
        list($level, $message) = $arguments;
        $message = sprintf("[%s] [after] %s", $level, $message);
        $engine = new MeiLiSearchEngine();
        $this->client = $engine->getEngine();

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
            'message' => $message,
            'time' => date("Y-md H:i:s")
        );
        $index->addDocuments($document);
        return true;
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

    private function getLogs()
    {
        $page = 1;
        $limit = 20;
        $offset = ($page-1)*$limit;
        $client = (new MeiLiSearchEngine())->getEngine();
        $index = $client->index(self::INDEX);
        return $index->search(null, [
            'offset'=>$offset,
            'limit'=>$limit,
            'sort'=>['id:desc']
        ])->getHits();
    }
}