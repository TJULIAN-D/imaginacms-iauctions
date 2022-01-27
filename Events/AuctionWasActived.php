<?php

namespace Modules\Iauctions\Events;

use Modules\User\Entities\Sentinel\User;

class AuctionWasActived
{
    
    public $notificationService;
    
    public function __construct()
    {

        $this->notificationService = app("Modules\Notification\Services\Inotification");

        $this->notification();
        
    }


    public function notification()
    {

        \Log::info('Iauctions: Events|AuctionWasActived|Notification');

        

    }

}

