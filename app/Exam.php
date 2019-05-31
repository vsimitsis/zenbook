<?php

namespace App;

use App\contracts\SectionParent;
use App\Traits\StatusRenderer;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model implements SectionParent
{
    use StatusRenderer;

    /**
     * The constant for exam open status
     */
    const STATUS_OPEN  = 1;

    /**
     * The constant for exam closed status
     */
    const STATUS_CLOSED = 2;

    /**
     * Constant for visible exam status
     */
    const HIDDEN  = 0;

     /**
     * Constant for visible exam status
     */
    const VISIBLE = 1;

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
     * Return the model name in lowercase
     *
     * @return string
     */
    public function getModelName() :string
    {
        return 'exam';
    }

    /**
     * Return the model name in plural for routes
     *
     * @return string
     */
    public function getModelUrlName() :string
    {
        return $this->getModelName() . 's';
    }
}
