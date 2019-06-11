<?php

namespace Modules\Iauctions\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WinnerAuction extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $subject;
    public $view;
    public $auction;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $auction
     * @param $subject
     * @param $view
     */
    public function __construct($user, $auction, $subject, $view)
    {
        $this->user=$user;
        $this->subject=$subject;
        $this->view=$view;
        $this->auction=$auction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)->subject($this->subject);
    }
}
