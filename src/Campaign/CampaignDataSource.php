<?php

namespace App\Campaign;

class CampaignDataSource
{
    /** @var Campaign[] $campaigns */
    private array $campaigns = [];

    public function add(Campaign $campaign): void
    {
        if (!isset($this->campaigns[$campaign->getId()])) {
            $this->campaigns[$campaign->getId()] = $campaign;
        }
    }

    public function getCampaign(): array
    {
        return $this->campaigns;
    }
}