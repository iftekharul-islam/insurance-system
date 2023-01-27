<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'n_admin',
        'n_noticeAdmin',
        'n_manager',
        'n_type',
        'n_type_id',
        'n_status',
    ];
}
