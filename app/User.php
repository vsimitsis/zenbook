<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company_id', 'company_role_id', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the user's first name
     *
     * @return mixed
     */
    public function firstName()
    {
        return explode(" ", $this->name)[0];
    }

    /**
     * Return the user's contacts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contacts()
    {
        return $this->belongsToMany('App\Contact');
    }

    /**
     * Return the company this user belongs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * Return the user's company role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function companyRole()
    {
        return $this->belongsTo('App\CompanyRole');
    }
}
