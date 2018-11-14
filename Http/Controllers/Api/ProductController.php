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

use Modules\Iauctions\Repositories\ProductRepository;
use Modules\Iauctions\Transformers\ProductTransformer;

use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;  //Base API

class ProductController extends BaseApiController
{

  private $product;

  public function __construct(
    ProductRepository $product
  ){

      parent::__construct();
      $this->product = $product;

  }

  /**
     * Get Data from Products
     *
     * @param Request $request
     * @return mixed
     */
  public function products(Request $request)
  {
      
    try {

      $p = $this->parametersUrl(false, false, false, []);
      $products = $this->product->index($p->page, $p->take, $p->filter, $p->include);

      $response = ["data" => ProductTransformer::collection($products)];
      
      //If request pagination add meta-page
      $p->page ? $response["meta"] = ["page" => $this->pageTransformer($products)] : false;
      
    } catch (\ErrorException $e) {

      $status = 500;
      $response = ['errors' => [
        "code" => "500",
        "source" => [
          "pointer" => "api/iauctions/products",
        ],
        "title" => "Error",
        "detail" => $e->getMessage()
      ]];

    }//catch

    return response()->json($response, $status ?? 200);


  }

  /**
     * Get Data by product
     *
     * @param Request $request
     * @return mixed
     */
  public function product($param,Request $request)
  {
    
    try {
       
      $p = $this->parametersUrl(false, false, false, []);
      $product = $this->product->show($param, $p->include);

      $response = ["data" => is_null($product) ? false : new ProductTransformer($product)];

    } catch (\Exception $e) {
     
      $status = 500;
      $response = [
        "code" => "500",
        "source" => [
          "pointer" => "api/iauctions/product",
        ],
        "title" => "Error",
        "detail" => $e->getMessage()
      ];
    }
    return response()->json($response, $status ?? 200);

  }



}
