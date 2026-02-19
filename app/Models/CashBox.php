<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashBox extends Model
{
    protected $fillable = [
        'name',
        'amount'
    ];
}
