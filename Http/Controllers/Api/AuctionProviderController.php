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

use Modules\Iauctions\Repositories\AuctionProviderRepository;
//use Modules\Iauctions\Transformers\AuctionProvidersTransformer;

use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;  //Base API

class AuctionProviderController extends BaseApiController
{

  private $auctionprovider;

  public function __construct(

    AuctionProviderRepository $auctionprovider

  ){

      parent::__construct();
      $this->auctionprovider = $auctionprovider;

  }

  /**
     * Store Auction with Provider 
     *
     * @param Request $request
     * @return mixed
     */
  public function store(Request $request)
  {
      try {

          // 'auction_id',
          // 'user_id',
          
          //$post = $this->post->create($request->all());
          dd($request);

          $status = 200;
          $response = [
              'success' => [
                  'code' => '201',
                  "source" => [
                      "pointer" => url($request->path())
                  ],
                  "title" => trans('core::core.messages.resource created', ['name' => trans('iblog::auctionproviders.singular')]),
                  "detail" => [
                      'id' => $auctionprovider->id
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

  
 
}
