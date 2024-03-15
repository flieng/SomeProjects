<?php

namespace App\Campaign\RuleCheck;

use App\Campaign\Campaign;

class MinimalRate extends AbstractValidator
{
    public function process(Campaign $campaign, string $publisherId): bool
    {
        $publisherEventCount = $campaign->getPublisherDataByEvent(
            publisherId: $publisherId,
            eventSource: $campaign->getOptimizationProps()->getSourceEvent()
        );
        if ($publisherEventCount <= $campaign->getOptimizationProps()->getThreshold()) {
//            var_dump(__FILE__);
//            var_dump($publisherId);
//            var_dump($publisherEventCount);
//            die;
            return parent::process(campaign: $campaign, publisherId: $publisherId);
        }

        return false;
    }

}