<?php

namespace Modules\Castalk\Achievements;

use Illuminate\Support\Facades\DB;
use Modules\Castalk\Abstracts\CastalkAchievementsAbstract;
use Modules\Core\Entities\Action;

class PlayTimeAchievement extends CastalkAchievementsAbstract
{
    public function handle(...$args)
    {

    }

    public function progress(): int
    {
        $data = Action::build('castalk', 'get-episodes-play-count',
            ['user_id' => $this->getUser()])->execute();
        return $data->play_count;
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
