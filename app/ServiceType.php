<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    const PAGINATE_PER_PAGE = 10;

    protected $fillable = [
        'name',
    ];

    /**Start Relations */
    public function services()
    {
        return $this->hasMany(Service::class, 'type_id');
    }
    /**End Relations */

    /**Start Scopes*/
    /**End Scopes */

    /**Start Mutators*/
    /**End Mutators */

    /**Start Helper*/
    /**End Helper*/
}
