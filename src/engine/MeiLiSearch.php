<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\Engine;

use LoggerDesign\Engine\Repository\BaseStorage;
use LoggerDesign\Engine\Repository\StorageInterface;

class MeiLiSearch extends BaseStorage implements StorageInterface
{
    public function save()
    {
        echo 1;
    }
}