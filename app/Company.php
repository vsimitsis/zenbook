<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return all the users that belong to this company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    /**
     * Return all the company administrators
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function administrators()
    {
        return $this->users()->where('user_role_id', userRole::ADMINISTRATOR);
    }

    /**
     * Return all the company managers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function managers()
    {
        return $this->users()->where('user_role_id', userRole::TEACHER);
    }

    /**
     * Return all the company employees
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->users()->where('user_role_id', userRole::STUDENT);
    }

    /**
     * Return all the company customers
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->hasMany('App\Customer');
    }
}
