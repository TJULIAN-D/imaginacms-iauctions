<?php

namespace Modules\Iauctions\Repositories\Cache;

use Modules\Iauctions\Repositories\BidRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheBidDecorator extends BaseCacheDecorator implements BidRepository
{
    public function __construct(BidRepository $bid)
    {
        parent::__construct();
        $this->entityName = 'iauctions.bids';
        $this->repository = $bid;
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
