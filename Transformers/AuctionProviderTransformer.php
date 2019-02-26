<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iprofile\Transformers\UserProfileTransformer;


class AuctionProviderTransformer extends Resource
{
  public function toArray($request)
  {

      $data=[
          'id'=>$this->when($this->id,$this->id),
          'provider_id'=>$this->when($this->provider_id,$this->provider_id),
          'auction_id'=>$this->when($this->auction_id,$this->auction_id),
          'status'=>$this->when($this->status,$this->status),
          'code_use'=>$this->when($this->code_use,$this->code_use),
          'created_at'=>$this->when($this->created_at,$this->created_at),
          'products'=> ProductTransformer::collection($this->whenLoaded('products')),
          'provider'=> new UserProfileTransformer($this->whenLoaded('provider')),
          'auction'=> new AuctionTransformer($this->whenLoaded('auction'))
      ];

      return $data;

  }
}
