<?php

namespace Modules\Iauctions\Events\Handlers;


use Illuminate\Contracts\Mail\Mailer;
use Modules\Iauctions\Events\AuctionWasCreated;

class SendEmailNewAuctionProvider
{

    public $auction;
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
    public function handle(AutionWasCreated $event)
    {

        $auctionProvider = $event->entity;
        $email=explode(',', $this->setting->get('iauctions::to-email'));
        if(!isset($email)||!count($email)){
            $email=env('MAIL_FROM_ADDRESS');
        }
        $subject = trans("iauctions::auctions.messages.New Provider for the auction: "). $auctionProvider->aution->title;
        $view = "iauctions::emails.auction.new_provider";
        $this->mail->to($email)->send(new NewAuctions($auctionProvider,$subject, $view));
    }


}
