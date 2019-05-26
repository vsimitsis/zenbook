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
    public function toPrimaryFormat(Carbon $date)
    {
        return $date->format(config('primary_date_format'));
    }
}