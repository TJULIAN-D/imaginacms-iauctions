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
use Modules\Iauctions\Transformers\AuctionTransformer;

use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;  //Base API

class AuctionController extends BaseApiController
{

  private $auction;

  public function __construct(
    AuctionRepository $auction
  ){

      parent::__construct();
      $this->auction = $auction;

  } 

   /**
     * Get Data from Auctions
     *
     * @param Request $request
     * @return mixed
     */
  public function auctions(Request $request)
  {
   
    try {

      $p = $this->parametersUrl(false, false, false, []);
      $auctions = $this->auction->index($p->page, $p->take, $p->filter, $p->include);

      $response = ["data" => AuctionTransformer::collection($auctions)];
      
      //If request pagination add meta-page
      $p->page ? $response["meta"] = ["page" => $this->pageTransformer($auctions)] : false;
      
    } catch (\ErrorException $e) {

      $status = 500;
      $response = ['errors' => [
        "code" => "500",
        "source" => [
          "pointer" => "api/iauctions/auctions",
        ],
        "title" => "Error",
        "detail" => $e->getMessage()
      ]];

    }//catch

    return response()->json($response, $status ?? 200);

  }

  /**
     * Get Data by auction
     *
     * @param Request $request
     * @return mixed
     */
  public function auction($param,Request $request)
  {
      try {
       
        $p = $this->parametersUrl(false, false, false, []);
        $auction = $this->auction->show($param, $p->include);

        $response = ["data" => is_null($auction) ? false : new AuctionTransformer($auction)];

    } catch (\Exception $e) {
       
        $status = 500;
        $response = [
          "code" => "500",
          "source" => [
            "pointer" => "api/iauctions/auction",
          ],
          "title" => "Error",
          "detail" => $e->getMessage()
        ];
    }
    return response()->json($response, $status ?? 200);

  }



}
