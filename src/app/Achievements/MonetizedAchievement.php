<?php

namespace Modules\Castalk\Achievements;

use Modules\Castalk\Abstracts\CastalkAchievementsAbstract;
use Modules\Castalk\Entities\Monetization;
use Modules\SocialNetwork\Abstracts\AchievementAbstract;

class MonetizedAchievement extends CastalkAchievementsAbstract
{
    public function handle(...$args)
    {
        // TODO: Implement handle() method.
    }

    public function progress(): int
    {
        $monetize = Monetization::query()
                ->where('user_id', $this->getUser())
                ->where('status', Monetization::ACCEPTED)
                ->exists();
        if ($monetize)
        {
            return 1;
        }
        else {
            return 0;
        }
    }

    public function target(): int
    {
        return 1;
    }
}
