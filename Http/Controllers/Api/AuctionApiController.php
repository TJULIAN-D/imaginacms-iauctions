<?php

namespace Modules\Iauctions\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iauctions\Entities\Auction;
use Modules\Iauctions\Repositories\AuctionRepository;

class AuctionApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Auction $model, AuctionRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
