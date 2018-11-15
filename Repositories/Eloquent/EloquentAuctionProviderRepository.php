<?php

namespace Modules\Iauctions\Repositories\Eloquent;

use Modules\Iauctions\Repositories\AuctionProviderRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentAuctionProviderRepository extends EloquentBaseRepository implements AuctionProviderRepository
{

    public function ByAuctionUser($auctionID,$userID){

        return $this->model->where([
            ['auction_id', '=', $auctionID], 
            ['user_id', '=', $userID]
        ])->first();
        
    }

}
