<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class notice_tbl extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'notice_validati',
        'noticestatus',
        'notice',
        'notice_dec'
    ];
}
