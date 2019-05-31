<?php

namespace App\Traits;

trait StatusRenderer
{
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

    /**
     * Return the exam's status to html
     *
     * @return string
     */
    public function visibilityToHtml() :string
    {
        switch ($this->visibility) {
            case self::VISIBLE:
                return '<span class="text-success">' . __('general.visible') . '</span>';
                break;
            case self::HIDDEN:
                return '<span class="text-danger">' . __('general.hidden') . '</span>';
                break;
            default:
                return '-';
        }
    }
}