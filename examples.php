<?php
/**
 * Author mapo
 * Date   2022/4/21
 */

use LoggerDesign\Log;
use Yosymfony\Toml\Toml;

require './vendor/autoload.php';

$log = Log::new();
$log->info("测试");
//$log->debug("测试");
//$log->waring("测试");
//$log->error("测试");
//$log->notice("测试");