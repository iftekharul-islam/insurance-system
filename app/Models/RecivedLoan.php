<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecivedLoan extends Model
{
    use HasFactory;

    protected $fillable = [
        'recived_amount'
    ];
}
