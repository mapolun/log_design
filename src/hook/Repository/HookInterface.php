<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

namespace LoggerDesign\Hook\Repository;

interface HookInterface
{
    public function before(...$arguments);

    public function after(...$arguments);
}