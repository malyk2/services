<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    const ROOT_NAME = 'admin';

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
        'pib',
        'position',
        'group_id',
        'active',
        'logout',
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
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }
    /**End relations */

    /**Start Mutators*/
    public function setPasswordAttribute($value)
    {
        ! empty($value) ? $this->attributes['password'] = bcrypt($value) : false;
    }
    /**End mutators */

    /**Start Helper*/
    public function getAllUserPerms()
    {
        return Cache::tags('user_roles_perms')->remember('user_id_'.$this->id, 10, function () {
            return $this->roles()->with('permissions')->get()->pluck('permissions')->flatten()->unique('id');
        });
    }

    public function hasPerm($perms, $strict = false)
    {
        if( is_array($perms)) {
            foreach($perms as $perm) {
                $hasPerm = $this->hasPerm($perm);
                if ($hasPerm && ! $strict) {
                    return true;
                } elseif ( ! $hasPerm && $strict) {
                    return false;
                }
            }
        } else {
            $allPerms = $this->getAllUserPerms();
            return $allPerms->contains('name', $perms);
        }
    }

    public function getAllGroups()
    {
        return Cache::tags('all_user_groups')->remember('user_id_'.$this->id, 10, function () {
            return Group::descendantsAndSelf($this->group_id);
        });
    }

    public function getTreeAllGroups($with = null)
    {
        $query = Group::query();
        ! empty($with) ? $query->with($with) : false;
        return $query->descendantsAndSelf($this->group_id)->toTree();
    }

    public function canEdit()
    {
        return ! ($this->isRoot() || $this->id == auth()->id());
    }

    public function canDelete()
    {
        return ! ($this->isRoot() || $this->id == auth()->id());
    }

    public function isRoot()
    {
        return $this->name == self::ROOT_NAME;
    }

    public function belogsUser(User $user)
    {
        return $user->getAllGroups()->contains('id', $this->group_id);
    }
    /**End Helper*/
}
