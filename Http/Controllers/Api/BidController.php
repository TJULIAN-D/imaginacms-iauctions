<?php

namespace Modules\Iauctions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Log;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Notification\Services\Notification;
use Modules\User\Contracts\Authentication;
use Modules\User\Repositories\UserRepository;
use Route;

use Modules\Iauctions\Repositories\AuctionRepository;
use Modules\Iauctions\Repositories\AuctionProviderRepository;
use Modules\Iauctions\Repositories\BidRepository;
//use Modules\Iauctions\Transformers\AuctionTransformer;

use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;  //Base API

class BidController extends BaseApiController
{

  private $bid;
  private $auction;
  private $auctionProvider;

  public function __construct(
    BidRepository $bid,
    AuctionRepository $auction,
    AuctionProviderRepository $auctionProvider
  ){

      parent::__construct();
      $this->bid = $bid;
      $this->auction = $auction;
      $this->auctionProvider = $auctionProvider;
  }

  /**
     * Store a Bid
     *
     * @param Request $request
     * @return mixed
     */
  public function store($auctionid, Request $request)
  {

    try {

      $user = $this->auth->user();

      // Check if Provider was APPROVED to create a Bid
      $provider = $this->auctionProvider->getByAuctionUser($auctionid,$user->id);
      if($provider->status==1){

        $request->merge(['auction_id' => $auctionid]);
        $request->merge(['user_id' => $user->id]);

        // Save Bid
        $bid = $this->bid->create($request->all());
        
        // Msjs
        $responseTitle = trans('core::core.messages.resource created', ['name' => trans('iauctions::bids.single')]);
        $statusTitle = "success";

      }else{

        $responseTitle = trans('iauctions::common.validation.record not created');
        $statusTitle = "warning";

      }
     
      $status = 200;
      $response = [
          $statusTitle => [
              'code' => '201',
              "source" => [
                  "pointer" => url($request->path())
              ],
              "title" =>  $responseTitle,
              "detail" => [
                  'auction_id' => $auctionid,
                  'bid_id' => isset($bid->id) ? $bid->id : false
              ]
          ]
      ];
    
    } catch (\Exception $e) {
      Log::error($e);
      $status = 500;
      $response = ['errors' => [
          "code" => "501",
          "source" => [
              "pointer" => url($request->path()),
          ],
          "title" => "Error Query Bid",
          "detail" => $e->getMessage()
      ]
      ];
    }

    return response()->json($response, $status ?? 200);
 
  }
  
  public function bids(Request $request)
  {
      
  }


  public function bid(Request $request)
  {
      
  }



}
