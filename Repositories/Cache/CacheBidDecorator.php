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
}
