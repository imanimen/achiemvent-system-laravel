<?php

class AcheievementController extends BaseController
{

	public function myAchiemvements()
	{
	        $pending = AchievementResource::collection( new AchievementResource(
                Achievement::query()
                    ->where('user_id', '=', $this->getUserId())
                    ->whereRaw('progress < target' )
                    ->get() )
        );
        $done = AchievementResource::collection( new AchievementResource(
                Achievement::query()
                    ->where('user_id', '=', $this->getUserId())
                    ->whereRaw('progress = target' )
                    ->get() )
        );
        return
            [
                'pending' => $pending,
                'done'    => $done
            ];
         }
            
}

