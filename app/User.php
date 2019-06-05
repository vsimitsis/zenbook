<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * Constant for User Active Status
     */
    const ACTIVE = 1;

    /**
     * Constant for User Pending Status
     */
    const PENDING = 2;

    /**
     * Constant for User Suspended Status
     */
    const SUSPENDED = 3;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Return the full name of the user
     *
     * @return string
     */
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Return the user's settings model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function settings()
    {
        return $this->hasOne(UserSetting::class);
    }

    /**
     * Return the html for the user's avatar render
     *
     * @return string
     */
    public function avatar()
    {
        if ($this->avatar) {
            return '<img src="' . Storage::url($this->avatar) . '"  alt="User Avatar"/>';
        }
        return '<span class="k-badge k-badge--username k-badge--lg k-badge--brand">' . mb_substr($this->first_name, 0, 1) . '</span>';
    }

    /**
     * Returns the user role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userRole()
    {
        return $this->belongsTo(UserRole::class);
    }

    /**
     * Return true if the user is a administrator
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->userRole === UserRole::ADMINISTRATOR;
    }

    /**
     * Return true if the user is a teacher
     *
     * @return bool
     */
    public function isTeacher()
    {
        return $this->userRole === UserRole::TEACHER;
    }

    /**
     * Return true if the user is a parent
     *
     * @return bool
     */
    public function isParent()
    {
        return $this->userRole === UserRole::PARENT;
    }

    /**
     * Return true if the user is a student
     *
     * @return bool
     */
    public function isStudent()
    {
        return $this->userRole === UserRole::STUDENT;
    }

    /**
     * Return all the user's classrooms
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }

    /**
     * Return the user's authored exams
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    /**
     * Return the user's contacts
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function contacts()
    {
        return $this->morphToMany(Contact::class, 'contactable');
    }

    /**
     * Return the user's addresses
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function addresses()
    {
        return $this->morphToMany(Address::class, 'addressable');
    }

    /**
     * Return the company this user belongs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Return all the documents this user has access to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function accessedDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    /**
     * Return a unique reference string for the user
     *
     * @param string $prefix
     * @return string
     */
    public static function generateUniqueID(string $prefix = null) :string
    {
        return $prefix . Str::random(12);
    }
}
