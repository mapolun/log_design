<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\AopService;

interface AopInterface
{
    public function before(...$arguments);

    public function after(...$arguments);
}