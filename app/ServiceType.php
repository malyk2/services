<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    const PAGINATE_PER_PAGE = 10;

    protected $fillable = [
        'name',
    ];
}
