<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Proxy;

abstract class BaseProxy
{
    //容器
    protected array $convertors = [];

    protected array $data = [];

    public function setConvertors(array $convertors) : BaseProxy
    {
        $this->convertors = $convertors;
        return $this;
    }

    //前置操作,观察者模式实现
    protected function before()
    {
        if ($this->convertors) {
            foreach ($this->convertors as $convertor) {

                if (method_exists($convertor, 'before')) {
                    $convertor->before(...$this->data);
                }
            }
        }
    }

    //后置操作,观察者模式实现
    protected function after()
    {
        if ($this->convertors) {
            foreach ($this->convertors as $convertor) {

                if (method_exists($convertor, 'after')) {
                    $convertor->after(...$this->data);
                }
            }
        }
    }
}