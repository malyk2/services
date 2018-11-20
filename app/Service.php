<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    const PAGINATE_PER_PAGE = 10;

    protected $fillable = [
        'user_id',
        'type_id',
        'price',
        'duration',
        'from',
        'to',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'from',
        'to',
    ];

    /**Start Relations */
    /**End Relations */

    /**Start Scopes*/
    /**End Scopes */

    /**Start Mutators*/
    /**End Mutators */

    /**Start Helper*/
    /**End Helper*/



}
