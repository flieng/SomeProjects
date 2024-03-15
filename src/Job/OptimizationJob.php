<?php

namespace App\Job;

use App\Campaign\Campaign;
use App\Campaign\CampaignDataSource;
use App\Campaign\OptimizationProps;
use App\Campaign\RuleCheck\RatioThreshold;
use App\Event\EventsDataSource;

class OptimizationJob
{
    public function run(): void
    {
        $campaignDS = new CampaignDataSource();
        $eventSourceDS = new EventsDataSource($campaignDS);
        $campaigns = [];

        echo '<pre>' . PHP_EOL;
        foreach ($eventSourceDS->getEventsSince('2 weeks ago') as $events) {
            if (!empty($campaigns[$events->getCampaignId()][$events->getPublisherId()][$events->getType()])) {
                ++$campaigns[$events->getCampaignId()][$events->getPublisherId()][$events->getType()];
            } else {
                $campaigns[$events->getCampaignId()][$events->getPublisherId()][$events->getType()] = 1;
            }
        }

        foreach ($campaigns as $campaignId => $publisherData) {
            $campaignData = new Campaign(
                new OptimizationProps('install', 'purchase', 3, 10),
                $campaignId
            );
            foreach ($publisherData as $publisherDatum => $sourceEvent) {
                foreach ($sourceEvent as $event => $eventCount) {
                    $campaignData->setPublisherData(
                        publisherId: $publisherDatum,
                        eventSource: $event,
                        eventCount: $eventCount
                    );
                }
            }

            $validator = new \App\Campaign\RuleCheck\MinimalRate();
            $validator->addHandler(new RatioThreshold());
            foreach ($campaignData->getPublisherData() as $publisherId => $publishers) {
                if ($validator->process($campaignData, $publisherId)) {
                    $campaignData->saveBlackList($publisherId);
                }
            }
            var_dump($campaignData);
        }
        echo '</pre>' . PHP_EOL;
    }
}