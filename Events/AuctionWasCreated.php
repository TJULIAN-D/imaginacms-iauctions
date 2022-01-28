<?php

namespace Modules\Iauctions\Events;

use Modules\User\Entities\Sentinel\User;

class AuctionWasCreated
{
    
    public $auction;
    public $notificationService;
    
    public function __construct($auction)
    {

        $this->auction = $auction;

        $this->notificationService = app("Modules\Notification\Services\Inotification");
        $this->notification();
        
    }


    public function notification()
    {

        // Base Users
        $responsable = $this->auction->user;
        $providers = $this->auction->department->users;

        //Set emailTo
        $emails[] = $responsable->email;
        $providersEmails = $providers->pluck('email')->toArray();
        $emailTo = array_merge($emails,$providersEmails);
       
        //Set BroadcastTo
        $broadcastTo = $providers->pluck('id')->toArray();
        array_push($broadcastTo, $responsable->id);
        //\Log::info("broadcastTo ".json_encode($broadcastTo));

        //FormatDates to email
        $formatStartAt = date(config('asgard.iauctions.config.hourFormat'),strtotime($this->auction->start_at));
        $formatEndAt = date(config('asgard.iauctions.config.hourFormat'),strtotime($this->auction->end_at));
        
        // Send Notification
        $this->notificationService->to([
            "email" => $emailTo,
            "broadcast" => $broadcastTo,
            "push" => $broadcastTo,
        ])->push([
            "title" => trans("iauctions::auctions.title.AuctionWasCreated"),
            "message" => trans("iauctions::auctions.messages.AuctionWasCreated",
            [
                "auctionId" => $this->auction->id,
                "title" => $this->auction->title,
                "startAt" => $formatStartAt,
                "endAt" =>  $formatEndAt
            ]),
            "icon_class" => "fa fa-bell",
            "setting" => [
                "saveInDatabase" => true
            ]
        ]);
        

    }

}

