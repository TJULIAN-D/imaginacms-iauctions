<?php

namespace Modules\Iauctions\Repositories\Cache;

use Modules\Iauctions\Repositories\ProductRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheProductDecorator extends BaseCacheDecorator implements ProductRepository
{
    public function __construct(ProductRepository $product)
    {
        parent::__construct();
        $this->entityName = 'iauctions.products';
        $this->repository = $product;
    }
}
