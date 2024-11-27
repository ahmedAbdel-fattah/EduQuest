<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'expiry_date',
        'cvv',
        'balance',
        'card_number',
    ];
}
