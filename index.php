<?php

require __DIR__ . '/vendor/autoload.php';

$startTime = microtime(true);

$handler    = new \LeadHandler\LeadHandler(2);
$status     = $handler->run(10000);

$finishTime = microtime(true) - $startTime;

echo  PHP_EOL . $status . PHP_EOL;
echo sprintf('execute time: %smin.', round($finishTime / 60));

