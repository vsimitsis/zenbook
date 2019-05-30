<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    /**
     * The constant for exam open status
     */
    const STATUS_OPEN  = 1;

    /**
     * The constant for exam closed status
     */
    const STATUS_CLOSED = 2;

    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return all the sections of this exam
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function sections()
    {
        return $this->morphMany(Section::class, 'parent');
    }

    /**
     * Return the exam's status to html
     *
     * @return string
     */
    public function statusToHtml() :string
    {
        switch ($this->status) {
            case self::STATUS_OPEN:
                return '<span class="text-success">' . __('general.open') . '</span>';
                break;
            case self::STATUS_CLOSED:
                return '<span class="text-danger">' . __('general.closed') . '</span>';
                break;
            default:
                return '-';
        }
    }
}
