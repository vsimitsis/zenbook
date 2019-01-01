<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The user that sent the invitation
     *
     * @var
     */
    public $currentUser;

    /**
     * The newly created account
     *
     * @var User
     */
    public $user;

    /**
     * The email subject
     *
     * @var
     */
    public $subject;

    /**
     * The set-password url
     *
     * @var string
     */
    public $url;

    /**
     * UserInvitation constructor.
     *
     * @param User $currentUser
     * @param User $user
     * @param string $token
     */
    public function __construct(User $currentUser, User $user, $token)
    {
        $this->currentUser = $currentUser;
        $this->user = $user;
        $this->subject = $currentUser->name . ' has invited you to join ' . $currentUser->company->name;
        $this->url = route('password.reset', $token);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->markdown('emails.user-invitation');
    }
}
