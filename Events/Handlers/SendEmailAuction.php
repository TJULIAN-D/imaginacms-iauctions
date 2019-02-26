<?php

namespace Modules\Iauctions\Events\Handlers;


use Illuminate\Contracts\Mail\Mailer;
use Modules\Iauctions\Events\AuctionWasCreated;

class SendEmailAuction
{

    public $auction;
    public $setting;
    private $mail;
    private $providers;

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

        $auction = $event->entity;
        $prividers = array();
        if (isset($auction->product)) {
            $ingredient = $auction->product->ingredient;
        } elseif ($auction->ingedent) {
            $ingredient = $auction->ingredient;
        }
        $products = $ingredient->products;
        if (count($products)) {

            foreach ($products as $product) {
                if (count($product->users)) {
                    foreach ($product->users as $user) {
                        if (!in_array($prividers)) {
                            $subject = trans("iauctions::auctions.messages.New auction available");
                            $view = "iauctions::emails.auction.new";
                            $this->mail->to()->send(new NewAuctions($auction,$user, $subject, $view));
                            array_push($providers, $user->email);
                        }

                    }
                }
            }
        }


    }
}