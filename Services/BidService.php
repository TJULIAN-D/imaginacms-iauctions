<?php

namespace Modules\Iauctions\Services;

use Modules\Iauctions\Repositories\BidRepository;
use Modules\Iauctions\Repositories\AuctionRepository;

class BidService
{

    private $bid;
    private $auction;

    public function __construct(
        BidRepository $bid,
        AuctionRepository $auction
    ){
       $this->bid = $bid;
       $this->auction = $auction;
    }

    /*
    * Create a BID
    */
    public function create($data){

        
        // Validate exist Auction and is active
        $auction = $this->auction->findByAttributes([
            'id'=> $data['auction_id'],
            'status' => 1 //ACTIVE = 1;
        ]);
        if(is_null($auction))
            throw new \Exception('Auction not Found or status Inactive', 500);

        //Validate if user doen't have Bids Actives
        $bids = $this->bid->findByAttributes([
            'provider_id'=> $data['provider_id'],
            'status' => 1 //RECEIVED = 1;
        ]);
        if(!is_null($bids))
            throw new \Exception('User has other bid received for this auction', 500);


        // Search if Auction category has a Bid Service to Calculate Points(Score)
        if(is_null($auction->category->bid_service)){
            $points = $data['amount'];
        }else{
            $points = app($auction->category->bid_service)->getPoints($data,$auction);
        }

        $data['points'] = $points;

        // Create BID
        $model = $this->bid->create($data);
            
        return $model;

    }

}