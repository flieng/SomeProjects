<?php

namespace App\Campaign\RuleCheck;

use App\Campaign\Campaign;

class RatioThreshold extends AbstractValidator
{
    public function process(Campaign $campaign, string $publisherId): bool
    {
        $publisherEventCount = $campaign->getPublisherDataByEvent(
            publisherId: $publisherId,
            eventSource: $campaign->getOptimizationProps()->getSourceEvent()
        );
        $publisherPurchaseEventCount = $campaign->getPublisherDataByEvent(
            publisherId: $publisherId,
            eventSource: $campaign->getOptimizationProps()->getMeasuredEvent()
        );

        if ($publisherEventCount && $publisherPurchaseEventCount
            && ($publisherPurchaseEventCount / $publisherEventCount * 100) < $campaign->getOptimizationProps()->getRatioThreshold()
        ) {
            return parent::process(campaign: $campaign, publisherId: $publisherId);
        }

        return false;
    }
}