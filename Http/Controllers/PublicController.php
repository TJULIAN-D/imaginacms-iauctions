<?php

namespace Modules\Iauctions\Http\Controllers;

use Mockery\CountValidator\Exception;
use Modules\Core\Http\Controllers\BasePublicController;
use Route;
use Log;
use Illuminate\Http\Request;
use Modules\User\Contracts\Authentication;
use Modules\Setting\Contracts\Setting;
use Modules\Iauctions\Repositories\AuctionRepository;


class PublicController extends BasePublicController
{

    public $subject;
    public $auction;

  public function __construct(AuctionRepository $auction)
  {

    parent::__construct();
      $this->auction=$auction;
   
  }
  
  /**
  * Index Method
  * @param
  * @return
  */
  public function index()
  {
     $auction=$this->auction->find(2);
     $user=$auction->winner->provider;

      return view('iauctions::emails.auctions.winner', compact('auction','user'));

  }
  
  
}