<?php

namespace Modules\Iauctions\Events;

use Modules\User\Entities\Sentinel\User;

class AuctionWasFinished
{
    
    public $notificationService;
    
    public function __construct()
    {

        $this->notificationService = app("Modules\Notification\Services\Inotification");

        $this->notification();
        
    }


    public function notification()
    {

        \Log::info('Iauctions: Events|AuctionWasFinished|Notification');

        

    }

}