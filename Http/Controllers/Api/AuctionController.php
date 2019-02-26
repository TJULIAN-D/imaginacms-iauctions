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
use Illuminate\Support\Facades\Auth;
use Modules\Iauctions\Repositories\AuctionRepository;
use Modules\Iauctions\Transformers\AuctionTransformer;
use Modules\Iauctions\Entities\UserProduct;
use Modules\Iauctions\Entities\Product;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;  //Base API

class AuctionController extends BaseApiController
{

  private $auction;
  private $userproduct;
  private $product;

  public function __construct(
    AuctionRepository $auction,
    UserProduct $userproduct,
    Product $product
  ){

      parent::__construct();
      $this->auction = $auction;
      $this->userproduct = $userproduct;
      $this->product = $product;

  }

   /**
     * Get Data from Auctions
     *
     * @param Request $request
     * @return mixed
     */

   /**
      * GET ITEMS
      *
      * @return mixed
      */
     public function index(Request $request)
     {
       try {
         //Get Parameters from URL.
         $params = $this->getParamsRequest($request);

         //Request to Repository
         $dataEntity = $this->auction->getItemsBy($params);

         //Response
         $response = ["data" => AuctionTransformer::collection($dataEntity)];

         //If request pagination add meta-page
         $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
       } catch (\Exception $e) {
         $status = $this->getStatusError($e->getCode());
         $response = ["errors" => $e->getMessage()];
       }

       //Return response
       return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
     }
     /**
        * GET A ITEM
        *
        * @param $criteria
        * @return mixed
        */
       public function show($criteria,Request $request)
       {
         try {
           //Get Parameters from URL.
           $params = $this->getParamsRequest($request);

           //Request to Repository
           $dataEntity = $this->auction->getItem($criteria, $params);

           //Break if no found item
           if(!$dataEntity) throw new Exception('Item not found',204);

           //Response
           $response = ["data" => new EntityTranformer($dataEntity)];

           //If request pagination add meta-page
           $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
         } catch (\Exception $e) {
           $status = $this->getStatusError($e->getCode());
           $response = ["errors" => $e->getMessage()];
         }

         //Return response
         return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
       }



}
