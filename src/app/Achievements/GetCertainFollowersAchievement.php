<?php

namespace Modules\Castalk\Achievements;

use Illuminate\Support\Facades\DB;
use Modules\Castalk\Abstracts\CastalkAchievementsAbstract;
use Modules\Castalk\Entities\UserFollow;
use Modules\SocialNetwork\Abstracts\AchievementAbstract;
use Modules\SocialNetwork\Entities\UserAchievements;

class GetCertainFollowersAchievement extends CastalkAchievementsAbstract
{

    public function handle(...$args)
    {

    }

    public function progress(): int
    {
        return UserFollow::query()
            ->where('following_id', $this->getUser() )
            ->count();
    }

    public function target(): int
    {
        $target = DB::table('castalk_achievement_list')
            ->where('level', 1)
            ->where('class', GetCertainFollowersAchievement::class)
            ->first();
        return $target->next;
    }


}
