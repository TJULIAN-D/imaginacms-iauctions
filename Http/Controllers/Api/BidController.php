<?php

namespace Modules\Iauctions\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Log;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Iauctions\Http\Requests\CreateBidRequest;
use Modules\Iauctions\Repositories\AuctionProviderRepository;
use Modules\Iauctions\Repositories\AuctionRepository;
use Modules\Iauctions\Repositories\BidRepository;
use Modules\Iauctions\Transformers\BidTransformer;
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
    public function index($aution, Request $request)
    {
        try {

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            $params->filter->aution = $aution;

            //Request to Repository
            $dataEntity = $this->bid->getItemsBy($params);

            //Response
            $response = ["data" => BidTransformer::collection($dataEntity)];

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
     * GET ITEMS
     *
     * @return mixed
     */
    public function getOrder($auction, Request $request)
    {
        try {
            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);
            $params->filter->auction = $auction;

            //Request to Repository
            $dataEntity = $this->bid->getItemsBy($params);

            $data = $dataEntity->groupBy(function ($item, $key) {
                return $item['code_user'];
            });

            foreach ($data as $index => $items) {
                $databids[] = new BidTransformer($items->where('total', $items->min('total'))->first());
            }


            //Response
            $response = ["data" => $databids];

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
    public function show($auction,$criteria, Request $request)
    {
        try {

            //Get Parameters from URL.
            $params = $this->getParamsRequest($request);

            //Request to Repository
            $dataEntity = $this->bid->getItem($criteria, $params);

            //Break if no found item
            if (!$dataEntity) throw new Exception('Item not found', 204);

            //Response
            $response = ["data" => new BidTransformer($dataEntity)];

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
     * @param  $auction_id
     * @param Request $request
     * @return mixed
     */
    public function create($auction_id, Request $request)
    {
        \DB::beginTransaction();
        try {

            $data = $request->input('attributes') ?? [];//Get data
            //Validate Request

            $user = Auth::user();

            $data['auction_id'] = $auction_id;
            $params = json_decode(json_encode(["filter" => ["status" => 2, "provider" => ["id" => $user->id, "status" => 1]], "include" => []]));
            $auction = $this->auction->getItem($data['auction_id'], $params);
            \Log::info($auction->finished_at);
            if ($auction->finished_at <= $auction->finished_at) {
                $paramsAuctionProvider = json_decode(json_encode(["filter" => ["auctions" => [$auction_id], "providers" => [$user->id]], "include" => [], "take" => 1]));
                $auctionProvider = $this->auctionProvider->getItemsBy($paramsAuctionProvider);

                //if (!count($auction)) {
                //    throw new Exception('Access denied', 403);
                //}
                $data['provider_id'] = $user->id;
                $data['code_user'] = $auctionProvider[0]->code_user;

                $this->validateRequestApi(new CreateBidRequest($data));

                //Create item
                $dataEntity = $this->bid->create($data);

                //Response
                $response = ["data" => new BidTransformer($dataEntity)];
                \DB::commit(); //Commit to Data Base
            }else{
                $status = 500;
                $response = ["errors" => 'Fecha no valida de Licitacion'];
            }
        } catch
        (\Exception $e) {
            \Log::error($e);
            \DB::rollback();//Rollback to Data Base
            $status = $this->getStatusError($e->getCode());
            $response = ["errors" => $e->getMessage()];
        }

//Return response
        return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
    }


}
