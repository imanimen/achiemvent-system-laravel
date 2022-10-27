<?php

namespace  Modules\Castalk\Abstracts;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Modules\Castalk\Entities\CastalkAchievement;
use Modules\Castalk\Notifications\NewAchievementNotification;
use Modules\Core\Entities\Action;
use Modules\SocialNetwork\Entities\UserAchievements;
use Modules\SocialNetwork\Interfaces\AchievementInterface;

abstract class CastalkAchievementsAbstract implements AchievementInterface
{

    private $user_id;
    public function __construct( $user_id )
    {
        $this->user_id = $user_id;
        if ($this->isCreated() == false) {
            $this->setUp();
        }
        else {
            $this->updateAchievement();
        }

        if ($this->checkTarget()) {
            $this->updateAchievement();
            $this->sendNotification();
            $this->newAchievement();

        }
    }

    public function getUser()
    {
        return $this->user_id;
    }

    public function isCreated()
    {
        return !is_null( $this->getModel($this->user_id) );
    }

    public function getModel()
    {
        return CastalkAchievement::whereClass( get_class( $this ) )->whereUserId( $this->user_id )->latest()->first();
    }

    public function setUp()
    {
        CastalkAchievement::create( [
            'user_id'  => $this->user_id ,
            'class'    => get_class( $this ) ,
            'progress' => $this->progress() ,
            'target'   => $this->target(),
            'level'    => 1,
            'status'   => CastalkAchievement::STATUS_PENDING
        ] );
    }

    public function getResponse()
    {
        $model = $this->getModel();
        return [
            'key'      => $this->key() ,
            'label'    => $this->label() ,
            'icon'     => $this->icon() ,
            'progress' => $model->progress ,
            'target'   => $model->target ,
        ];
    }

    public function key()
    {
        return get_class( $this );
    }

    public function label()
    {
        return 'test';
    }

    public function icon()
    {
    }

    public function updateAchievement()
    {
        $update =  CastalkAchievement::query()
            ->where('user_id', $this->user_id)
            ->where('class', get_class($this))
            ->whereRaw('progress < target')->first();
        $update?->update([
            'progress' => $this->progress(),
            'status' =>  CastalkAchievement::STATUS_PENDING
        ]);
        $done = CastalkAchievement::query()
            ->where('user_id', $this->user_id)
            ->where('class', get_class($this))
            ->whereRaw('progress = target')->first();
        $done?->update([
            'status' => CastalkAchievement::STATUS_DONE,
        ]);


    }

    public function checkTarget()
    {

        return CastalkAchievement::query()
            ->where('user_id', '=', $this->user_id)
            ->where('class' , get_class($this))
            ->whereRaw('progress = target')
            ->exists();

    }


    public function updateTarget()
    {
        return  CastalkAchievement::query()
            ->where('user_id',  $this->user_id)
            ->where('level', $this->getLevel())
            ->update(['target' => $this->getNewTarget()]);
    }

    protected function sendNotification()
    {
        Action::build('castalk', 'send-notification', [
            'type' => NewAchievementNotification::class,
            'data' => json_encode([
                'user_id' => $this->user_id,
                'achievement_type' => get_class( $this ),
                'achievement_value' => $this->target()
            ]),
            'notifiable_id' => $this->user_id,
            'notifiable_type' => User::class
        ])->execute();
    }

    public function getLevel()
    {
        $model = $this->getModel();
        return $model->level;
    }

    public function getNewTarget()
    {
        $target =  DB::table('castalk_achievement_list')
            ->where('class', get_class($this))
            ->where('level', $this->getLevel() + 1)
            ->first();
        return $target->next;
    }

    public function updateLevel()
    {
        CastalkAchievement::query()
            ->where('user_id', $this->user_id)
            ->where('class', get_class($this))
            ->update(['level' => $this->getLevel() + 1]);
    }

    public function newAchievement()
    {
        $check =  CastalkAchievement::query()
            ->where('class', get_class($this))
            ->where('user_id', $this->user_id)
            ->where('status', CastalkAchievement::STATUS_DONE)
            ->exists();
        if ($check)
        {
            CastalkAchievement::create( [
                'user_id'  => $this->user_id ,
                'class'    => get_class( $this ) ,
                'progress' => $this->progress() ,
                'target'   => $this->getNewTarget(),
                'level'    => $this->getLevel() + 1,
                'status'   => CastalkAchievement::STATUS_PENDING
            ] );
        }
    }
}
