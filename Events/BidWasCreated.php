<?php

namespace Modules\Iauctions\Events;

use Modules\User\Entities\Sentinel\User;

class BidWasCreated
{
    
    public $bid;
    public $notificationService;
    
    public function __construct($bid)
    {

        $this->bid = $bid;
        $this->notificationService = app("Modules\Notification\Services\Inotification");
        $this->notification();
        
    }


    public function notification()
    {

        // Set emailTo Responsable
        $emailTo = $this->bid->auction->user->email;

        // Set BroadcastTo
        $broadcastTo = $this->bid->auction->user->email;

        // Send Notification
        $this->notificationService->to([
            "email" => $emailTo,
            "broadcast" => $broadcastTo,
            "push" => $broadcastTo,
        ])->push([
            "title" => trans("iauctions::bids.title.BidWasCreated",[
                "bidId" => $this->bid->id,
                "auctionInfor" => $this->bid->auction->id
            ]),
            "message" => trans("iauctions::bids.messages.BidWasCreated",
            [
                "bidId" => $this->bid->id,
                "providerInfor" => $this->bid->provider->email,
                "auctionInfor" => $this->bid->auction->title
            ]),
            "icon_class" => "fa fa-bell",
            "setting" => [
                "saveInDatabase" => true
            ]
        ]);
        

    }

}

