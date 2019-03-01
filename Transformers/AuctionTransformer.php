<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iauctions\Transformers\ProductTransformer;

class AuctionTransformer extends Resource
{
  public function toArray($request)
  {


      $data=[
          'id'=>$this->when($this->id,$this->id),
          'title'=>$this->when($this->title,$this->title),
          'description' => $this->when($this->description,$this->description),
          'base_price'=>$this->when($this->base_price,$this->base_price),
          'finished_at'=>$this->when($this->finished_at,$this->finished_at),
          'started_at'=>$this->when($this->started_at,$this->started_at),
          'quantity'=>$this->when($this->quantity,$this->quantity),
          'area'=>$this->when($this->area,$this->area),
          'longerterm'=>$this->when($this->longerterm,$this->longerterm),
          'financialcost_daily'=>$this->when($this->financialcost_daily,$this->financialcost_daily),
          'financialcost_monthly'=>$this->when($this->financialcost_monthly,$this->financialcost_monthly),
          'longerterm_freight'=>$this->when($this->longerterm_freight,$this->longerterm_freight),
          'status'=>$this->when($this->status,$this->status),
          'statusName'=>$this->when($this->status,$this->present()->status()),
          'user_id'=>$this->when($this->user_id,$this->user_id),
          'winner_id'=>$this->when($this->winner_id,$this->winner_id),
          'options'=>$this->when($this->options,$this->options),
          'providers'=> AuctionProviderTransformer::collection($this->whenLoaded('auctionProviders')),
          'product'=> new  ProductTransformer($this->whenLoaded('product')),
      ];

    return $data;

  }
}
