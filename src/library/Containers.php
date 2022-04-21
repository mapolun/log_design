<?php

/**
 * Author mapo
 * Date   2022/4/21
 */
namespace LoggerDesign\Library;

class Containers
{
    protected string $name;

    protected array $convertors = [];

    public function get(string $name = "")
    {
        if (empty($name)) {
            return $this->convertors;
        }

        if (!isset($this->convertors[$this->name])) {
            return null;
        }

        return $this->convertors[$this->name];
    }

    /**
     * @throws \ReflectionException
     */
    public function add(string $name, $class)
    {
        if (!isset($this->convertors[$name])) {
            $reflection = new \ReflectionClass($class);
            $this->convertors[$name] = $reflection->newInstance();
        }
    }

    public function clear(string $name = "")
    {
        if (isset($this->convertors[$name])) {
            unset($this->convertors[$name]);
        }
    }

    public function has(string $name = ""): bool
    {
        return isset($this->convertors[$name]);
    }
}