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
}
