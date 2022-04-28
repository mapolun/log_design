<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Hook;


use LoggerDesign\Engine\MongoDbEngine;
use LoggerDesign\Hook\Repository\HookInterface;

class MongoDb implements HookInterface
{
    public function before(...$arguments){}

    public function after(...$arguments)
    {
        list($level, $message) = $arguments;
        $message = sprintf("[%s] [after] %s", $level, $message);
        $engine = new MongoDbEngine(['db'=>'snk']);
        $data = [
            'data' => $message,
            'create_time' => time()
        ];
        $result = $engine->insert($data)->execute("log");
        if ($result->getInsertedCount() == 0) {
            return false;
        }

        //查询
//        $page = 1;
//        $size = 10;
//        $skip = ($page-1)*$size;
//        $where = [
//            "create_time" => ['$gt'=>0]
//        ];
//        $options = [
//            'projection' => ['_id'=>1,'create_time'=>1,'data'=>1],
//            'sort' => ['create_time'=>-1],
//            'limit'=>$size,
//            'skip'=>$skip
//        ];
//        $list = $engine->select('log', $where, $options);
//        $count = $engine->count('log',[]);
//        echo "存储mongo成功，共{$count}条日志数据" . PHP_EOL;
        return true;
    }
}