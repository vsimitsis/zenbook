<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    /**
     * The constant for exam open status
     */
    const OPEN_STATUS  = 1;

    /**
     * The constant for exam closed status
     */
    const CLOSED_STATUS = 2;

    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the exam's status to html
     *
     * @return string
     */
    public function statusToHtml() :string
    {
        switch ($this->status) {
            case self::OPEN_STATUS:
                return '<span class="text-success">' . __('general.open') . '</span>';
                break;
            case self::CLOSED_STATUS:
                return '<span class="text-danger">' . __('general.closed') . '</span>';
                break;
            default:
                return '-';
        }
    }
}
