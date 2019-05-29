<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * Constant for public access
     */
    const PUBLIC_ACCESS = 1;

    /**
     * Constant for shared access
     */
    const SHARED_ACCESS = 2;

    /**
     * Constant for private access
     */
    const PRIVATE_ACCESS = 3;

    /**
     * Constant for valid file types
     */
    const VALID_FILE_TYPES = [
        '.txt'  => 'text/plain',
        '.csv'  => 'text/csv',
        '.pdf'  => 'application/pdf',
        '.gif'  => 'image/gif',
        '.png'  => 'image/png',
        '.jpg'  => 'image/jpeg',
        '.zip'  => 'application/zip',
        '.rar'  => 'application/x-rar-compressed',
        '.xls'  => 'application/vnd.ms-excel',
        '.xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        '.doc'  => 'application/msword',
        '.docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        '.odt'  => 'application/vnd.oasis.opendocument.text',
        '.ppt'  => 'application/vnd.ms-powerpoint',
        '.pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
    ];

    /**
     * The attributes that are not mass assignable
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Return the user this document belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Return the company this document belongs to
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Return the document's access to html
     *
     * @return string
     */
    public function accessToHtml() :string
    {
        switch ($this->access) {
            case self::PUBLIC_ACCESS:
                return '<span class="text-success">' . __('general.public') . '</span>';
                break;
            case self::SHARED_ACCESS:
                return '<span class="text-warning">' . __('general.shared') . '</span>';
                break;
            case self::PRIVATE_ACCESS:
                return '<span class="text-danger">' . __('general.private') . '</span>';
                break;
            default:
                return '-';
        }
    }

    /**
     * Return the path for amazon S3 documents
     *
     * @param Company $company
     * @param User $user
     * @return string
     */
    public static function buildS3Path(Company $company, User $user)
    {
        return $company->unique_ref . '/' . $user->unique_ref . '/documents/';
    }
}
