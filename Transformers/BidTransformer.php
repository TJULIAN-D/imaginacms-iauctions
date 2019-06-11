<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iauctions\Transformers\AuctionTransformer;
use Modules\Iauctions\Transformers\ProductTransformer;
use Modules\Iprofile\Transformers\UserTransformer;

class BidTransformer extends Resource
{
  public function toArray($request)
  {

    $includes = explode(",", $request->include);

    /*Values to return*/
    $data = [
      'id' => $this->id,
      'price' => $this->price,
      'longerterm' => $this->longer_term,
      'tax' => $this->tax,
      'freight_term' => $this->freight_term,
      'freight_price' => $this->freight_price,
      'total_price' => $this->total_price,
      'options' => $this->options,
      'code_user' => $this->code_user,
      'provider_id' => $this->provider_id,
      'provider'=>new UserTransformer($this->whenLoaded('provider')),
      'concentration' => $this->concentration,
      'created_at' => $this->created_at,
      'total' => $this->present()->total
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
