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

class BidController extends BasePublicController
{

  

  public function __construct()
  {

      parent::__construct();

  }

  
  public function bids(Request $request)
  {
      
  }


  public function bid(Request $request)
  {
      
  }



}
