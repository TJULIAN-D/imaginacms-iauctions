<?php

namespace Modules\Iauctions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Log;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Iauctions\Entities\AuctionProvider;
use Modules\Iauctions\Http\Requests\CreateAuctionProviderRequest;
use Modules\Iauctions\Repositories\AuctionProviderRepository;
use Modules\Iauctions\Repositories\AuctionRepository;
use Modules\Iauctions\Transformers\AuctionProviderTransformer;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Notification\Services\Notification;
use Modules\User\Repositories\UserRepository;
use Route;

//Base API

class AuctionProviderController extends BaseApiController
{

    private $auctionProvider;
    protected $auth;
    private $user;
    private $auction;

    public function __construct(
        AuctionProviderRepository $auctionProvider,
        UserRepository $user,
        AuctionRepository $auction
    )
    {

        parent::__construct();
        $this->auctionProvider = $auctionProvider;
        $this->user = $user;
        $this->auction = $auction;
    }

    /**
     * Store Auction with Provider and Products
     *
     * @param $auction_id
     * @param Request $request
     * @return mixed
     */


    public function store($auction_id, Request $request)
    {

        \DB::beginTransaction();
        try {
            $data = $request->input('attributes') ?? [];                                                          //Get data
            $auth = Auth::user();
            $data['auction_id'] = $auction_id;
            $data['code_user'] = str_random(8);
            if ($auth->hasAccess('iauctions.auctionproviders.index')) {
                $data['provider_id'] = $data['provider_id'] ?? $auth->id;
                $data['status'] = $data['status'] ?? 1;
            } else {
                $data['provider_id'] = $auth->id;
                $data['status'] = 0;
            }
            $this->validateRequestApi(new CreateAuctionProviderRequest($data));
            $dataEntity = $this->auctionProvider->create($data);

//Response
            $response = [
                'susses' => [
                    'code' => '201',
                    "source" => [
                        "pointer" => url($request->path())
                    ],
                    "title" => trans('iauctions::auctions.messages.create'),
                    "detail" => [
                        'id' => $dataEntity->id
                    ]
                ]
            ];                                          //Response
            \DB::commit();                                                                                      //Commit to Data Base
        } catch (\Exception $e) {
            \DB::rollback();                                                                                    //Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
            \Log::error($e);
        }

        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);                 //Return response
    }


    /**
     * GET ITEMS
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        try {

            //Get Parameters from URL.F
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->auctionProvider->getItemsBy($params);

            //Response
            $response = ["data" => AuctionProviderTransformer::collection($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            \Log::error($e);
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
     * @param Request $request
     * @return mixed
     */
    public function show($criteria, Request $request)
    {
        try {

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->auctionProvider->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new \Exception('Item not found', 204);

            //Response
            $response = ["data" => new AuctionProviderTransformer($dataEntity)];

            //If request pagination add meta-page
            $params->page ? $response["meta"] = ["page" => $this->pageTransformer($dataEntity)] : false;
        } catch (\Exception $e) {
            \Log::error($e);
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * UPDATE ITEM
     *
     * @param $criteria
     * @param Request $request
     * @return mixed
     */
    public function update($criteria, Request $request)
    {
        \DB::beginTransaction(); //DB Transaction
        try {
            //Get data
            $data = $request->input('attributes') ?? [];//Get data

            //Validate Request
            $this->validateRequestApi(new CreateAuctionProviderRequest($data));

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);
            //Request to Repository
            $dataEntity = $this->auctionProvider->getItem($criteria, $params);
            //Request to Repository
            $this->auctionProvider->update($dataEntity, $data);

            //Response
            $response = ["data" => 'Item Updated'];
            \DB::commit();//Commit to DataBase
        } catch (\Exception $e) {
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }

    /**
     * Get AuctionProvider (GENERAL) and Products
     *
     * @param Request $request
     * @return mixed
     */
    public function auctionprovider(AuctionProvider $auctionProvider, Request $request)
    {

        try {
            if (isset($auctionProvider->id) && !empty($auctionProvider->id)) {

                $response = ["data" => is_null($auctionProvider) ? false : new AuctionProviderTransformer($auctionProvider)];

            } else {
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
        } catch (\Exception $e) {
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

    public function auctionuser($auctionid, Request $request)
    {

        try {
            $user = Auth::user();

            $auctionProvider = $this->auctionprovider->ByAuctionUser($auctionid, $user->id);

            if (isset($auctionProvider->id) && !empty($auctionProvider->id)) {

                $response = ["data" => is_null($auctionProvider) ? false : new AuctionProviderTransformer($auctionProvider)];

            } else {

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

        } catch (\Exception $e) {
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
