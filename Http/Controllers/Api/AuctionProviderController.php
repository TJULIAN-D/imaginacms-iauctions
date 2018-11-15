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
use Modules\Iauctions\Repositories\AuctionProviderProductRepository;
use Modules\Iauctions\Transformers\AuctionProviderTransformer;

use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;  //Base API

use Modules\Iauctions\Entities\AuctionProvider;

class AuctionProviderController extends BaseApiController
{

  private $auctionprovider;
  protected $auth;
  private $user;
  private $auction;
  private $auctionproviderproduct;

  public function __construct(
    AuctionProviderRepository $auctionprovider,
    Authentication $auth,
    UserRepository $user,
    AuctionRepository $auction,
    AuctionProviderProductRepository $auctionproviderproduct

  ){

      parent::__construct();
      $this->auctionprovider = $auctionprovider;
      $this->auth = $auth;
      $this->user = $user;
      $this->auction = $auction;
      $this->auctionproviderproduct = $auctionproviderproduct;
  }

  /**
     * Store Auction with Provider and Products
     *
     * @param Request $request
     * @return mixed
     */
  public function store($auctionid,Request $request)
  {
      try {

        $auction = $this->auction->find($auctionid);

        // Auction is Pending or Published
        if($auction->status==1 || $auction->status==2){
            
            $user = $this->auth->user();
            $request->merge(['user_id' => $user->id]);
            $request->merge(['auction_id' => $auction->id]);
            
            // Save Provider
            $auctionprovider = $this->auctionprovider->create($request->all());
           
            // Save Products
            $productsID = array();
            $productsID = explode(",", $request->productsid);

            foreach ($productsID as $productID) {
                $param = [
                    'auctionprovider_id'  => $auctionprovider->id,
                    'product_id'    => $productID,
                ];
                $auctionproviderproduct = $this->auctionproviderproduct->create($param);
            }

            // Msjs
            $responseTitle = trans('core::core.messages.resource created', ['name' => trans('iauctions::auctionproviders.single')]);
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
                    'auction_id' => $auction->id,
                    'auctionprovider_id' => isset($auctionprovider->id) ? $auctionprovider->id : false
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
              "title" => "Error Query AuctionProvider",
              "detail" => $e->getMessage()
          ]
          ];
      }
      return response()->json($response, $status ?? 200);

  }


 
   /**
     * Get AuctionProvider (GENERAL) and Products
     *
     * @param Request $request
     * @return mixed
     */
  public function auctionprovider(AuctionProvider $auctionProvider,Request $request){

    try{
        if (isset($auctionProvider->id) && !empty($auctionProvider->id)) {
            
            $response = ["data" => is_null($auctionProvider) ? false : new AuctionProviderTransformer($auctionProvider)];
            
        }else {
            $status = 404;
            $response = ['errors' => [
                "code" => "404",
                "source" => [
                    "pointer" => url($request->path()),
                ],
                "title" => "Not Found",
                "detail" => 'Query empty'
            ]];
        }
    }catch (\Exception $e){
        Log::error($e);
        $status = 500;
        $response = ['errors' => [
            "code" => "501",
            "source" => [
                "pointer" => url($request->path()),
            ],
            "title" => "Error Query post",
            "detail" => $e->getMessage()
        ]
        ];
    }

    return response()->json($response, $status ?? 200);

  }

   /**
     * Get AuctionProvider by Auction, User and Products
     *
     * @param Request $request
     * @return mixed
     */

   public function auctionuser($auctionid,Request $request){

        try{

            $user = $this->auth->user();
            $auctionProvider = $this->auctionprovider->ByAuctionUser($auctionid,$user->id);

            if (isset($auctionProvider->id) && !empty($auctionProvider->id)) {
                
                $response = ["data" => is_null($auctionProvider) ? false : new AuctionProviderTransformer($auctionProvider)];
                
            }else {

                $status = 404;
                $response = ['errors' => [
                    "code" => "404",
                    "source" => [
                        "pointer" => url($request->path()),
                    ],
                    "title" => "Not Found",
                    "detail" => 'Query empty'
                ]];
            }

        }catch (\Exception $e){
            Log::error($e);
            $status = 500;
            $response = ['errors' => [
                "code" => "501",
                "source" => [
                    "pointer" => url($request->path()),
                ],
                "title" => "Error Query post",
                "detail" => $e->getMessage()
            ]
            ];
        }
    
        return response()->json($response, $status ?? 200);
    
    }
 
}
