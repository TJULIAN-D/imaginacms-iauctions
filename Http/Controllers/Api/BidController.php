<?php

namespace Modules\Iauctions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Log;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Iauctions\Repositories\AuctionProviderRepository;
use Modules\Iauctions\Repositories\AuctionRepository;
use Modules\Iauctions\Repositories\BidRepository;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;
use Modules\Notification\Services\Notification;
use Modules\User\Contracts\Authentication;
use Modules\User\Repositories\UserRepository;
use Route;

//Base API

class BidController extends BaseApiController
{

    private $bid;
    private $auction;
    private $auctionProvider;

    public function __construct(
        BidRepository $bid,
        AuctionRepository $auction,
        AuctionProviderRepository $auctionProvider
    )
    {

        parent::__construct();
        $this->bid = $bid;
        $this->auction = $auction;
        $this->auctionProvider = $auctionProvider;
    }


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
            $dataEntity = $this->repoEntity->getItemsBy($params);

            //Response
            $response = ["data" => EntityTranformer::collection($dataEntity)];

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
     * @return mixed
     */
    public function show($criteria, Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->repoEntity->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Response
            $response = ["data" => new EntityTranformer($dataEntity)];

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
     * CREATE A ITEM
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        \DB::beginTransaction();
        try {
            $data = $request->input('attributes') ?? [];//Get data
            //Validate Request

            $user = Auth::user();
            $auction=$this->auction->getItem($data['auction_id'], json_decode('"filter":{"status":2, "provider":{"id":1,"status":1}}'));

            $this->validateRequestApi(new CustomRequest($data));

            //Create item
            $dataEntity = $this->repoEntity->create($data);

            //Response
            $response = ["data" => new EntityTranformer($dataEntity)];
            \DB::commit(); //Commit to Data Base
        } catch (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }
        //Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
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
            //return $request->all();
            $user = Auth::user();

            // Check if Provider was APPROVED to create a Bid
            $provider = $this->auctionProvider->ByAuctionUser($auctionid, $user->id);

            if ($provider->status == 1) {

                $request->merge(['auction_id' => $auctionid]);
                $request->merge(['user_id' => $user->id]);

                // Save Bid
                $bid = $this->bid->create($request->all());
                // send pusher

                //update longerterm if up now
                $auction = $this->auction->find($auctionid);
                if ($request->longerterm > $auction->longerterm) {
                    $this->auction->update($auction, ['longerterm' => $request->longerterm]);
                    //send pusher
                }

                // Msjs
                $responseTitle = trans('core::core.messages.resource created', ['name' => trans('iauctions::bids.single')]);
                $statusTitle = "success";

            } else {

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
                    "title" => $responseTitle,
                    "detail" => [
                        'auction_id' => $auctionid,
                        'bid_id' => isset($bid->id) ? $bid->id : false
                    ]
                ]
            ];

        } catch (\Exception $e) {
            \Log::error($e);
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

}
