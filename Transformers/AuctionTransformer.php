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
          'longerterm'=>$this->when($this->longer_term,$this->longer_term),
          'financial_cost_daily'=>$this->when($this->financial_cost_daily,$this->financial_cost_daily),
          'financial_cost_monthly'=>$this->when($this->financial_cost_monthly,$this->financial_cost_monthly),
          'longer_term_freight'=>$this->when($this->longer_term_freight,$this->longer_term_freight),
          'status'=>$this->when($this->status,$this->status),
          'place_delivery'=>$this->when($this->place_delivery,$this->place_delivery),
          'date_delivery'=>$this->when($this->date_delivery,$this->date_delivery),
          'product_unit'=>$this->when($this->product_unit,$this->product_unit),
          'statusName'=>$this->when($this->status,$this->present()->status()),
          'user_id'=>$this->when($this->user_id,$this->user_id),
          'product_id'=>$this->when($this->product_id,$this->product_id),
          'winner_id'=>$this->when($this->winner_id,$this->winner_id),
          'options'=>$this->when($this->options,$this->options),
          'providers'=> AuctionProviderTransformer::collection($this->whenLoaded('auctionProviders')),
          'product'=> new  ProductTransformer($this->whenLoaded('product')),
          'bids'=>BidTransformer::collection($this->whenLoaded('bids'))
      ];
      if($request->winner){
          $items=$this->whenLoaded('bids');
          $data['bidWinner']= new BidTransformer($items->where('total', $items->min('total'))->first());
      }

    return $data;

  }
}
