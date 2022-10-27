<?php

namespace Modules\Castalk\Achievements;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\Castalk\Abstracts\CastalkAchievementsAbstract;
use Modules\Castalk\Entities\Like;
use Modules\Castalk\Entities\Podcast;
use Modules\Castalk\Entities\PodcastEpisode;
use Modules\SocialNetwork\Abstracts\AchievementAbstract;

class OpenAppAchievement extends CastalkAchievementsAbstract
{
	public function handle( ...$args )
	{

	}

    public function progress(): int
    {
        // todo
        return 1;
    }

    public function target(): int
    {
        // todo
        return 7;
    }
}
