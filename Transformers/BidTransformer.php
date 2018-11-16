<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iauctions\Transformers\AuctionTransformer;
use Modules\Iauctions\Transformers\ProductTransformer;

class BidTransformer extends Resource
{
  public function toArray($request)
  {

    $includes = explode(",", $request->include);

    /*Values to return*/
    $data = [
      'id' => $this->id,
      'user_id' => $this->user_id,
      'price' => $this->price,
      'longerterm' => $this->longerterm,
      'tax' => $this->tax,
      'freight_term' => $this->freight_term,
      'freight_price' => $this->freight_price,
      'total_price' => $this->total_price,
      'options' => $this->options
    ];

     /*Transform Relation Ships*/
    if (in_array('auction', $includes)) {
      $data['auction'] = new AuctionTransformer($this->auction);
    }

    if (in_array('product', $includes)) {
      $data['product'] = new ProductTransformer($this->product);
    }

    return $data;

  }
}
