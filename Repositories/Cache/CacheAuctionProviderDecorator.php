<?php

namespace Modules\Iauctions\Repositories\Cache;

use Modules\Iauctions\Repositories\AuctionProviderRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAuctionProviderDecorator extends BaseCacheDecorator implements AuctionProviderRepository
{
    public function __construct(AuctionProviderRepository $auctionprovider)
    {
        parent::__construct();
        $this->entityName = 'iauctions.auctionproviders';
        $this->repository = $auctionprovider;
    }
}
