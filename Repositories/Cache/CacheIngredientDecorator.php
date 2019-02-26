<?php

namespace Modules\Iauctions\Repositories\Cache;

use Modules\Iauctions\Repositories\IngredientRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheIngredientDecorator extends BaseCacheDecorator implements IngredientRepository
{
    public function __construct(IngredientRepository $ingredient)
    {
        parent::__construct();
        $this->entityName = 'iauctions.ingredients';
        $this->repository = $ingredient;
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
