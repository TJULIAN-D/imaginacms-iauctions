<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iauctions\Transformers\AuctionProviderProductTransformer;

class AuctionProviderTransformer extends Resource
{
  public function toArray($request)
  {

    $includes = explode(",", $request->include);

    /*Values to return*/
    $data = [
      'id' => $this->id,
      'auction_id' => $this->auction_id,
      'user_id' => $this->user_id,
      'status' => $this->status,
      'statusName' => iauctions_get_status()->get($this->status)
    ];

    if (in_array('products', $includes)) {
      $data["relationships"]["auctionproviderproducts"] = AuctionProviderProductTransformer::collection($this->auctionproviderproducts);
    }
      
    return $data;

  }
}
