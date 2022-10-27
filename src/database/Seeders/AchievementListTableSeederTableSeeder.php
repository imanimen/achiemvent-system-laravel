<?php

namespace Modules\Castalk\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Castalk\Achievements\FirstTransactionAchievement;
use Modules\Castalk\Achievements\GetCertainFollowersAchievement;
use Modules\Castalk\Achievements\LikedEpisodesAchievement;
use Modules\Castalk\Achievements\MonetizedAchievement;
use Modules\Castalk\Achievements\OpenAppAchievement;
use Modules\Castalk\Achievements\PlayTimeAchievement;
use Modules\Castalk\Achievements\PublishFirstEpisodeAchievement;

class CastalkAchievementListTableSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('achievement_list')->insert([
            'level' => 1,
            'previous' => 0,
            'next' => 20,
            'class' => GetCertainFollowersAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('achievement_list')->insert([
            'level' => 2,
            'previous' => 20,
            'next' => 100,
            'class' => GetCertainFollowersAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('achievement_list')->insert([
            'level' => 1,
            'previous' => 0,
            'next' => 100,
            'class' => PlayTimeAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('achievement_list')->insert([
            'level' => 2,
            'previous' => 100,
            'next' => 500,
            'class' => PlayTimeAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('achievement_list')->insert([
            'level' => 1,
            'previous' => 0,
            'next' => 7,
            'class' => OpenAppAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('achievement_list')->insert([
            'level' => 1,
            'previous' => 0,
            'next' => 1,
            'class' => FirstTransactionAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('achievement_list')->insert([
            'level' => 1,
            'previous' => 0,
            'next' => 20,
            'class' => LikedEpisodesAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('achievement_list')->insert([
            'level' => 2,
            'previous' => 20,
            'next' => 100,
            'class' => LikedEpisodesAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('achievement_list')->insert([
            'level' => 21,
            'previous' => 0,
            'next' => 1,
            'class' => MonetizedAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('achievement_list')->insert([
            'level' => 1,
            'previous' => 0,
            'next' => 1,
            'class' => PublishFirstEpisodeAchievement::class,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

    }
}
