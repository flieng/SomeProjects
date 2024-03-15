<?php

require "vendor/autoload.php";

$validator = new \App\Campaign\RuleCheck\MinimalRate();

$validator
    ->addHandler(new \App\Campaign\RuleCheck\BaseValidate())
    ->addHandler(new \App\Campaign\RuleCheck\MinimalRate());

//$result = $validator->process(10, 'purchase');

//var_dump($result);


$optimizatorJob = new \App\Job\OptimizationJob();
echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB' . PHP_EOL;
$optimizatorJob->run();

echo round(memory_get_usage() / 1024 / 1024, 2) . ' MB'. PHP_EOL;