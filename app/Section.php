<?php

namespace App;

use App\Traits\StatusRenderer;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use StatusRenderer;

    /**
     * Constant for visible section status
     */
    const HIDDEN  = 0;

    /**
     * Constant for visible section status
     */
    const VISIBLE = 1;

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

    /**
     * Return all section's modules
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }
}
