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

        \Log::info('Iauctions: Events|AuctionWasCreated|Notification');

        

    }

}

