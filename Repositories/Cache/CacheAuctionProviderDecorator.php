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

    /**
     * @param $auctionID
     * @param $userID
     * @return mixed
     */
    public function ByAuctionUser($auctionID, $userID)
    {
        return $this->remember(function () use ($auctionID, $userID) {
            return $this->repository->ByAuctionUser($auctionID, $userID);
        });
    }
}
