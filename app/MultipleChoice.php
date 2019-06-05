<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultipleChoice extends Model
{
    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return all multiple choice module choices
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
}
