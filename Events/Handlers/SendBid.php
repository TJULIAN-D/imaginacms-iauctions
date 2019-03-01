<?php

namespace Modules\Iauctions\Events\Handlers;


use Illuminate\Contracts\Mail\Mailer;
use Modules\Iauctions\Events\BidWasCreated;

class SendBid
{

    public $setting;
    private $mail;


    public function __construct(Mailer $mail)
    {
        $this->mail = $mail;
        $this->setting = app('Modules\Setting\Contracts\Setting');
    }

    /**
     * @param AutionWasCreated $event
     */
    public function handle(BidWasCreated $event)
    {

    }
}