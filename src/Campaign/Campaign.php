<?php

namespace App\Campaign;

class Campaign
{
    private array $publisherBlacklist = [];
    private $pubisherData = [];

    public function __construct(
        private OptimizationProps $optimizationProps,
        private string $id
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function setPublisherData(string $publisherId, string $eventSource, int $eventCount): void
    {
        $this->pubisherData[$publisherId][$eventSource] = $eventCount;
    }

    public function getPublisherData(): array
    {
        return $this->pubisherData;
    }

    public function getPublisherBlacklist(): array
    {
        return $this->publisherBlacklist;
    }

    public function getPublisherDataByEvent(string $publisherId, string $eventSource): int
    {
        return $this->pubisherData[$publisherId][$eventSource] ?? 0;
    }

    public function getOptimizationProps(): OptimizationProps
    {
        return $this->optimizationProps;
    }

    public function saveBlackList(string $publisher): void
    {
        if (!isset($this->publisherBlacklist[$publisher])) {
            $this->publisherBlacklist[$publisher] = $publisher;
        }
    }
}