<?php

namespace App\Event;

use App\Campaign\CampaignDataSource;

class EventsDataSource
{
    public function __construct(
        private CampaignDataSource $campaignDataSource
    ) {}

    public function getEventsSince(string $from)
    {
        /**
         * this approach only for generate mock data like it was getting from any DB.
         */
        $iterations = match (true) {
            (time() - strtotime($from)) > 0 => ceil((time() - strtotime($from)) / 7200),
            default => 0
        };

        $generatedData = [];
        $types = ['install', 'registration', 'app_open', 'purchase'];
        $generatedTs = time();
        $campaigns = [uniqid('campaignId_'), uniqid('campaignId_'), uniqid('campaignId_'), uniqid('campaignId_')];
        $publishers = [uniqid('purchaseId_'), uniqid('purchaseId_'), uniqid('purchaseId_')];

        for ($i = 0; $i < $iterations; ++$i) {
            $generatedData = new Event(
                $types[mt_rand(0, 3)],
                $campaigns[mt_rand(0, 3)],
                $publishers[mt_rand(0, 2)],
                random_int(strtotime($from), $generatedTs)
            );

            yield $generatedData;
        }

        return $generatedData;
    }

}