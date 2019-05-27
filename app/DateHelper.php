<?php

namespace App;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Return the given Carbon instance formatted into Primary Date Format
     *
     * @param Carbon $date
     * @return string
     */
    public static function toPrimaryFormat(Carbon $date) :string
    {
        return $date->format(config('primary_date_format'));
    }

    /**
     * Returns the calendar button thumbnail date
     *
     * @return string
     */
    public static function calendarDayTranslator() :string
    {
        return __('dates.' . lcfirst(Carbon::now()->format('F'))) . ' ' . Carbon::now()->format('d');
    }
}