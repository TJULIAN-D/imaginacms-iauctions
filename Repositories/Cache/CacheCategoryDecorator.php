<?php

namespace Modules\Iauctions\Repositories\Cache;

use Modules\Iauctions\Repositories\CategoryRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheCategoryDecorator extends BaseCacheDecorator implements CategoryRepository
{
    public function __construct(CategoryRepository $category)
    {
        parent::__construct();
        $this->entityName = 'iauctions.categories';
        $this->repository = $category;
    }
}
