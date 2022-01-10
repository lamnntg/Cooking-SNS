<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;
    protected $table = 'notifications';

    const TYPE_RECIPE = 1;
    const TYPE_FOLLOW = 2;
    const STATUS_UNREAD = 0;
    const STATUS_READ = 1;

    protected $fillable = [
        'follower_id',
        'user_id',
        'content',
        'type',
        'status'
    ];
}
