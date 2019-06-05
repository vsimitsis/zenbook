<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the QuestionAnswer module this answer belongs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function questionAnswer()
    {
        return $this->belongsTo(QuestionAnswer::class);
    }

    /**
     * Return the user that wrote this answer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the user that graded this answer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gradedBy()
    {
        return $this->belongsTo(User::class, 'user_graded_id');
    }
}
