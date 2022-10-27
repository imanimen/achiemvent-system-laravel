<?php

namespace Modules\Castalk\Achievements;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Modules\Castalk\Abstracts\CastalkAchievementsAbstract;
use Modules\Castalk\Entities\Like;
use Modules\Castalk\Entities\Podcast;
use Modules\Castalk\Entities\PodcastEpisode;
use Modules\SocialNetwork\Abstracts\AchievementAbstract;

class LikedEpisodesAchievement extends CastalkAchievementsAbstract
{
	public function handle( ...$args )
	{

	}

    public function progress(): int
    {
        $episodes = PodcastEpisode::query()->whereHas('season.podcast', function (Builder $q) {
            $q->where('user_id', $this->getUser());
        })->pluck('id');
        $likeCount = Like::query()->where('owner_type', PodcastEpisode::class)
            ->whereIn('owner_id', $episodes)->count();
        return $likeCount;

    }

    public function target(): int
    {

        $target = DB::table('castalk_achievement_list')
            ->where('level', 1)
            ->where('class', get_class($this))
            ->first();
        return $target->next;
    }
}
