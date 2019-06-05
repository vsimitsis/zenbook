<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Constant for administrator UserRole
     */
    const ADMINISTRATOR = 1;

    /**
     * Constant for Teacher UserRole
     */
    const TEACHER = 2;

    /**
     * Constant for Student UserRole
     */
    const PARENT = 3;

    /**
     * Constant for parent UserRole
     */
    const STUDENT = 4;

    /**
     * Return the users with this role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
