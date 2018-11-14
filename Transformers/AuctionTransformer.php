<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iauctions\Transformers\ProductTransformer;

class AuctionTransformer extends Resource
{
  public function toArray($request)
  {

    $includes = explode(",", $request->include);

    /*Values to return*/
    $data = [
      "id" => $this->id,
      'description' => $this->description,
      'base_price' => $this->base_price,
      'started_at' => iauctions_format_date($this->started_at),
      'finished_at' => iauctions_format_date($this->finished_at),
      'quantity' => $this->quantity,
      'area' => $this->area,
      'longerterm' => $this->longerterm,
      'financialcost_daily' => $this->financialcost_daily,
      'financialcost_monthly' => $this->financialcost_monthly,
      'longerterm_freight' => $this->longerterm_freight,
      'status' => $this->status,
      'statusName' => iauctions_get_statusAuction()->get($this->status),
      'user_id' => $this->user_id,
      'winner_id' => $this->winner_id,
      'options' => $this->options
    ];

     /*Transform Relation Ships*/
    if (in_array('product', $includes)) {
        $data['product'] = new ProductTransformer($this->product);
    }


    return $data;

  }
}
