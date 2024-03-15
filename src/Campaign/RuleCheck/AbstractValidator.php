<?php

namespace App\Campaign\RuleCheck;

use App\Campaign\Campaign;

abstract class AbstractValidator implements Handler
{
    private /*Handler*/ $nextHandler;

    public function addHandler(Handler $handler): Handler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function process(Campaign $campaign, string $publisherId): bool
    {
        if ($this->nextHandler) {
            return $this->nextHandler->process($campaign, $publisherId);
        }

        return true;
    }

}