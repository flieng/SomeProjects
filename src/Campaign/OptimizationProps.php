<?php

namespace App\Campaign;

class OptimizationProps implements IOptimizationProps
{
    public function __construct(
        private string $sourceEvent,
        private string $measuredEvent,
        private int $threshold,
        private int $ratioThreshold
    ) {}

    public function getSourceEvent(): string
    {
        return $this->sourceEvent;
    }

    public function getMeasuredEvent(): string
    {
        return $this->measuredEvent;
    }

    public function getThreshold(): int
    {
        return $this->threshold;
    }

    public function getRatioThreshold(): int
    {
        return $this->ratioThreshold;
    }
}