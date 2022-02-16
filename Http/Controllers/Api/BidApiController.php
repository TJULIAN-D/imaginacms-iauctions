<?php

namespace Modules\Iauctions\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;

use Illuminate\Http\Request;
//Default transformer
use Modules\Core\Icrud\Transformers\CrudResource;

//Model
use Modules\Iauctions\Entities\Bid;
use Modules\Iauctions\Repositories\BidRepository;

class BidApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;
  public $bidService;

  public function __construct(Bid $model, BidRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
    $this->bidService = app('Modules\Iauctions\Services\BidService');
  }


  /**
   * Controller to create model
   *
   * @param Request $request
   * @return mixed
   */
  public function create(Request $request)
  {
    \DB::beginTransaction();
    try {
      //Get model data
      $modelData = $request->input('attributes') ?? [];

      //Validate Request
      if (isset($this->model->requestValidation['create'])) {
        $this->validateRequestApi(new $this->model->requestValidation['create']($modelData));
      }

      //Bid Service to Validate and Create BID
      $model = $this->bidService->create($modelData);

      //Response
      $response = ["data" => CrudResource::transformData($model)];
      \DB::commit(); //Commit to Data Base
    } catch (\Exception $e) {
      \DB::rollback();//Rollback to Data Base
      //$status = $this->getStatusError($e->getCode());
      //$response = ["errors" => $e->getMessage()];
      $response = ["messages" => [["message" => $e->getMessage(), "type" => "error"]]];
    }
    //Return response
    return response()->json($response ?? ["data" => "Request successful"], $status ?? 200);
  }


}
