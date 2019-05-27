<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the model that owns this address
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function addressable()
    {
        return $this->morphTo();
    }
}
