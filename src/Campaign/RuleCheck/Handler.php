<?php

namespace App\Campaign\RuleCheck;

use App\Campaign\Campaign;

interface Handler
{
    public function addHandler(Handler $handler);
    public function process(Campaign $campaign, string $publisherId);
}