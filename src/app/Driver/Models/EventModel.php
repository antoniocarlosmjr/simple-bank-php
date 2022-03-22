<?php

namespace App\Driver\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $fillable = [
        'type',
        'status',
        'account_id_origin',
        'account_id_destination',
        'amount',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
