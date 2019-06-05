<?php

namespace App;

use App\Traits\StatusRenderer;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use StatusRenderer;

    /**
     * Constant for visible module status
     */
    const HIDDEN  = 0;

    /**
     * Constant for visible module status
     */
    const VISIBLE = 1;

    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the section this module belongs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    /**
     * Return the examinable model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function examinable()
    {
        return $this->morphTo();
    }

    /**
     * Return the module type of the module
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function moduleType()
    {
        return $this->belongsTo(ModuleType::class);
    }
}
