<?php

namespace Modules\Iauctions\Events;

use Modules\User\Entities\Sentinel\User;

class WinnerWasSelected
{
    
    public $auction;
    public $bid;
    public $notificationService;
    
    public function __construct($bid)
    {
        $this->bid = $bid;
        $this->auction = $bid->auction;
        $this->notificationService = app("Modules\Notification\Services\Inotification");
        $this->notification();
    }


    public function notification()
    {

        /*
        * Email to Winner Bid Provider
        * Email to Auction Responsable
        */
        $emailTo = [];
        array_push($emailTo,$this->bid->provider->email,$this->auction->user->email);
         
        $broadcastTo = [];
        array_push($broadcastTo,$this->bid->provider->id,$this->auction->user->id);

    
        // Send Notification
        $this->notificationService->to([
            "email" => $emailTo,
            "broadcast" => $broadcastTo,
            "push" => $broadcastTo,
        ])->push([
            "title" => trans("iauctions::auctions.title.WinnerWasSelected",["auctionId" => $this->auction->id]),
            "message" => trans("iauctions::auctions.messages.WinnerWasSelected",
            [
                "auctionId" => $this->auction->id,
                "title" => $this->auction->title,
                "bidWinner" => $this->bid->provider->email
            ]),
            "icon_class" => "fa fa-bell",
            "setting" => [
                "saveInDatabase" => true
            ]
        ]);

        

    }

}

