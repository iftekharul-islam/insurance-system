<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'last_time',
        'last_login_time',
        'user_ip',
        'user_mac',
        'login_hours',
        'device',
        'user_browser',
        'user_os',
        'login_country',
        'last_login',
    ];
}
