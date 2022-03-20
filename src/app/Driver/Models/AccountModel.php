<?php

namespace App\Driver\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    protected $fillable = [
        'id',
        'type',
        'active',
        'balance',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
