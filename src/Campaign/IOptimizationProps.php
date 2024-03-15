<?php

namespace App\Campaign;

interface IOptimizationProps
{
    public function getThreshold(): int;
    public function getSourceEvent(): string;
    public function getMeasuredEvent(): string;
    public function getRatioThreshold(): int;
}