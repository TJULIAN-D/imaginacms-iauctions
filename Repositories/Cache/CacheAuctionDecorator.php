<?php

namespace Modules\Iauctions\Repositories\Cache;

use Modules\Iauctions\Repositories\AuctionRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAuctionDecorator extends BaseCacheDecorator implements AuctionRepository
{
    public function __construct(AuctionRepository $auction)
    {
        parent::__construct();
        $this->entityName = 'iauctions.auctions';
        $this->repository = $auction;
    }
}
