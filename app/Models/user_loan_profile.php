<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_loan_profile extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [];
    public function user()
    {
        return $this->belongsTo(User::class,'loan_officer_id','id');
    }

    public function  manageuser()
    {
        return $this->belongsTo(User::class,'manager_id','id');
    }

   

    
}
