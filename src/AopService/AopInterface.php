<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\AopService;

interface AopInterface
{
    public function before();

    public function after();
}