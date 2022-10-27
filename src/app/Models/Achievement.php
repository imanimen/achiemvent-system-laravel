<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model
{
    use SoftDeletes;

    protected $table = 'user_achievements';
    protected $fillable = [ 'user_id', 'class', 'progress', 'target', 'level', 'status' ];

    const STATUS_PENDING = 0;
    const STATUS_DONE = 1;

}

