<?php

namespace Modules\Iauctions\Repositories\Cache;

use Modules\Iauctions\Repositories\AuctionProviderProductRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAuctionProviderProductDecorator extends BaseCacheDecorator implements AuctionProviderProductRepository
{
    public function __construct(AuctionProviderProductRepository $auctionproviderproduct)
    {
        parent::__construct();
        $this->entityName = 'iauctions.auctionproviderproducts';
        $this->repository = $auctionproviderproduct;
    }
}
