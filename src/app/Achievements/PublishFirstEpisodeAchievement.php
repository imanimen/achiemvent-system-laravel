<?php

namespace Modules\Castalk\Achievements;

use Modules\Castalk\Abstracts\CastalkAchievementsAbstract;
use Modules\Castalk\Entities\PodcastEpisode;
use Modules\SocialNetwork\Abstracts\AchievementAbstract;

class PublishFirstEpisodeAchievement extends CastalkAchievementsAbstract
{
    public function handle(...$args)
    {

    }

    public function progress(): int
    {
        return 1;
    }

    public function target(): int
    {
        return 1;
    }
}
