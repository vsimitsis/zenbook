<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the user's language locale or fetch the default
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    public function locale()
    {
        return $this->language()->locale ?? config('app.locale');
    }

    /**
     * Return the user these settings belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the language these settings refer to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
