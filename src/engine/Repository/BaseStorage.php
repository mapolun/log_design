<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Engine\Repository;

use JetBrains\PhpStorm\Pure;

class BaseStorage
{
    protected mixed $data;

    #[Pure] public static function create(): static
    {
        return new static();
    }

    public function setData(mixed $data) : static
    {
        $this->data = $data;
        return $this;
    }
}