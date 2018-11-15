<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iauctions\Transformers\ProductTransformer;

class AuctionProviderProductTransformer extends Resource
{
  public function toArray($request)
  {

    //$includes = explode(",", $request->include);

    /*Values to return*/
    $data = [
      'id' => $this->id,
      'auctionprovider_id' => $this->auctionprovider_id,
      'product_id' => $this->product_id
    ];

    $data['product'] = new ProductTransformer($this->product);
    

    return $data;

  }
}
