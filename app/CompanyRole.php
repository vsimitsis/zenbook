<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRole extends Model
{
    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    const ADMINISTRATOR = 1;
    const MANAGER       = 2;
    const EMPLOYEE      = 3;

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
