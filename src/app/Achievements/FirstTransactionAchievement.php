<?php

namespace Modules\Castalk\Achievements;

use Modules\Castalk\Abstracts\CastalkAchievementsAbstract;
use Modules\SocialNetwork\Abstracts\AchievementAbstract;

class FirstTransactionAchievement extends CastalkAchievementsAbstract
{
    public function handle(...$args)
    {
        // TODO: Implement handle() method.
    }

    public function progress(): int
    {
        return 0;
    }

    public function target(): int
    {
        return 0;
    }
}
