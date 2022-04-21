<?php
/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\Proxy;

class Proxy extends BaseProxy
{
    //代理对象
    protected mixed $obj;

    //代理，策略模式
    public function __construct(string $class)
    {
        if (!class_exists($class)) {
            throw new \Exception("{$class} 类不存在");
        }

        $this->obj = new $class();
    }

    /**
     * @throws \ReflectionException
     */
    public function __call(string $name, $arguments)
    {
        $refClass = new \ReflectionClass($this->obj);
        $method = $refClass->getMethod($name);
        if (!$method) {
            throw new \Exception("{$name} 方法不存在");
        }

        if ($method->isAbstract() || !$method->isPublic()) {
            throw new \Exception("{$name} 方法不能执行");
        }

        $this->data = array_merge([$name], $arguments);

        /*
         |--------------------------------------------------------------------------
         | 前置操作
         |--------------------------------------------------------------------------
         |
         */
        if (method_exists($this, 'before')) {
            $this->before();
        }

        /*
         |--------------------------------------------------------------------------
         | 执行代理方法
         |--------------------------------------------------------------------------
         |
         */
        $this->obj->$name(...$arguments);

        /*
         |--------------------------------------------------------------------------
         | 后置操作
         |--------------------------------------------------------------------------
         |
         */
        if (method_exists($this, 'after')) {
            $this->after();
        }
    }
}