<?php

namespace Modules\Icommerce\Http\Controllers;

use Mockery\CountValidator\Exception;

use Modules\Core\Http\Controllers\BasePublicController;
use Route;
use Log;
use Illuminate\Http\Request;

use Modules\User\Contracts\Authentication;
use Modules\Setting\Contracts\Setting;


class PublicController extends BasePublicController
{
  
  
  public function __construct()
  {

    parent::__construct();
   
  }
  
  /**
  * Index Method
  * @param
  * @return
  */
  public function index()
  {
    
    
  }
  
  
}