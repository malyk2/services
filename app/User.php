<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const PAGINATE_PER_PAGE = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**Start relations */
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    /**End relations */

    /**Start Mutators*/
    public function setPasswordAttribute($value)
    {
        ! empty($value) ? $this->attributes['password'] = bcrypt($value) : false;
    }
    /**End mutators */

    /**Start Helper*/
    /**End Helper*/
}
