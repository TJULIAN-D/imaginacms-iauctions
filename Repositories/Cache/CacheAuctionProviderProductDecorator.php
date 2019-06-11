<?php

namespace Modules\Iauctions\Repositories\Cache;

use Modules\Iauctions\Repositories\AuctionProviderProductRepository;
use Modules\Iauctions\Repositories\AuctionProviderRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheAuctionProviderProductDecorator extends BaseCacheDecorator implements AuctionProviderProductRepository
{
    public function __construct(AuctionProviderProductRepository $auctionProviderProduct)
    {
        parent::__construct();
        $this->entityName = 'iauctions.auctionproviders';
        $this->repository = $auctionProviderProduct;
    }

    /**
     * @param bool $params
     * @return mixed
     */
    public function getItemsBy($params = false)
    {
        return $this->remember(function () use ($params) {
            return $this->repository->getItemsBy($params);
        });
    }


    /**
     * @param $criteria
     * @param bool $params
     * @return mixed
     */
    public function getItem($criteria, $params = false)
    {
        return $this->remember(function () use ($criteria, $params) {
            return $this->repository->getItem($criteria, $params);
        });
    }
}
