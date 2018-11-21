<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'client_email',
        'from',
        'to',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'from',
        'to',
    ];
}
