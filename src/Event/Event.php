<?php

namespace App\Event;

class Event
{
    /**
     * @param int $ts
     * @param string $type
     * @param string $campaignId
     * @param string $publisherId
     */
    public function __construct(
        private string $type,
        private string $campaignId,
        private string $publisherId,
        private int $ts
    ) {}

    public function getType(): string
    {
        return $this->type;
    }

    public function getTs(): int
    {
        return $this->ts;
    }

    public function getCampaignId(): string
    {
        return $this->campaignId;
    }

    public function getPublisherId(): string
    {
        return $this->publisherId;
    }
}