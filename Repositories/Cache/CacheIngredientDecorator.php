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
}
