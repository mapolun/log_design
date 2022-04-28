<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Engine;


use LoggerDesign\Engine\Repository\BaseEngine;
use LoggerDesign\Engine\Repository\EngineInterface;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Command;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

class MongoDbEngine extends BaseEngine implements EngineInterface
{
    protected $db;

    protected BulkWrite $bulk;

    public function __construct(array $options = [])
    {
        parent::__construct();
        $this->engine = new Manager("mongodb://{$this->config['username']}:{$this->config['password']}@{$this->config['host']}:{$this->config['port']}");
        if (isset($options['db']) && $options['db']) {
            $this->db = $options['db'];
        }
        $this->bulk = new BulkWrite();
    }

    public function getEngine() : Manager
    {
        return $this->engine;
    }

    public function setBulk(BulkWrite $bulkWrite) : MongoDbEngine
    {
        $this->bulk = $bulkWrite;
        return $this;
    }

    public function insert(array $data) : MongoDbEngine
    {
        $this->bulk->insert($data);
        return $this;
    }

    public function update(array $data, array $where): MongoDbEngine
    {
        $this->bulk->update($where, $data);
        return $this;
    }

    public function delete(array $where): MongoDbEngine
    {
        $this->bulk->delete($where);
        return $this;
    }

    public function select(string $document, array $where, $options)
    {
        $query = new Query($where, $options);
        return $this->engine->executeQuery(sprintf('%s.%s', $this->db, $document), $query);
    }

    public function count(string $document, array $where)
    {
        $query = new Query($where, []);
        $command = new Command(['count'=>$document, 'query'=>$query]);
        return $this->engine->executeCommand($this->db, $command)->toArray()[0]->n ?? 0;
    }

    public function execute(string $document): \MongoDB\Driver\WriteResult
    {
        return $this->engine->executeBulkWrite(sprintf('%s.%s', $this->db, $document), $this->bulk);
    }
}