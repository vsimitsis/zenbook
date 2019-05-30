<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * The constant for the open section status
     */
    const STATUS_OPEN = 1;

    /**
     * The constant for the closed section status
     *
     */
    const STATUS_CLOSED = 2;

    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the parent of this section
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parent()
    {
       return $this->morphTo('parent');
    }
}
