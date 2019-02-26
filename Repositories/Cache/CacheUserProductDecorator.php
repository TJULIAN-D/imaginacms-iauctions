<?php

namespace Modules\Iauctions\Repositories\Cache;

use Modules\Iauctions\Repositories\UserProductRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheUserProductDecorator extends BaseCacheDecorator implements UserProductRepository
{
    public function __construct(UserProductRepository $userproduct)
    {
        parent::__construct();
        $this->entityName = 'iauctions.userproducts';
        $this->repository = $userproduct;
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
