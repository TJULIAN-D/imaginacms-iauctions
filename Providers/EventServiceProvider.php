<?php

namespace Modules\Iauctions\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Iauctions\Events\Handlers\SendEmailAuction;
use Modules\Ientitys\Events\AuctionWasCreated;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        AuctionWasCreated::class => [
            SendEmailAuction::class,
        ]

    ];
}