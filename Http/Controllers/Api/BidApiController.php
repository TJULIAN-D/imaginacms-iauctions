<?php

namespace Modules\Iauctions\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iauctions\Entities\Bid;
use Modules\Iauctions\Repositories\BidRepository;

class BidApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Bid $model, BidRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
