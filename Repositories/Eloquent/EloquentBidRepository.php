<?php

namespace Modules\Iauctions\Repositories\Eloquent;

use Modules\Iauctions\Repositories\BidRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentBidRepository extends EloquentBaseRepository implements BidRepository
{

    /**
     * Return bids by parameters
     *
     * @param $page
     * @param $take
     * @param $filter
     * @param $include
     * @return mixed
     */
    public function index($page, $take, $filter, $include){
        $query = $this->model->query();

        /*== FILTER ==*/
        if ($filter) {

            if(isset($filter->AuctionID)){
                $query->where("auction_id",$filter->AuctionID);
            }
            
            //Add order By
            $orderBy = isset($filter->orderBy) ? $filter->orderBy : 'created_at';
            $orderType = isset($filter->orderType) ? $filter->orderType : 'desc';
            $query->orderBy($orderBy, $orderType);

        }

        /*=== REQUEST ===*/
         if ($page) {//Return request with pagination
            $take ? true : $take = 12; //If no specific take, query default take is 12
            return $query->paginate($take);
        } else {//Return request without pagination
            $take ? $query->take($take) : false; //Set parameter take(limit) if is requesting
            return $query->get();
        }

    }

     /**
     * Return bid data
     *
     * @param $id
     * @param $include
     * @return mixed
     */
    public function show($param, $include)
    {
        //Initialize Query
        $query = $this->model->query();
        $query = $this->model->where('id', $param);

        /*=== REQUEST ===*/
        return $query->first();
    }


}
