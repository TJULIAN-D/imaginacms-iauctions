<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Iauctions\Transformers\CategoryTransformer;
use Modules\Iauctions\Transformers\IngredientTransformer;

class ProductTransformer extends Resource
{
  public function toArray($request)
  {

    $includes = explode(",", $request->include);

    /*Values to return*/
    $data = [
      'id' => $this->id, 
      'name' => $this->name,
      'slug' => $this->slug,
      'unity' => $this->unity,
      'unityName' => iauctions_get_unity()->get($this->unity),
      'concentration' => $this->concentration,
      'dosis_ha' => $this->dosis_ha,
      'status' => $this->status,
      'statusName' => iauctions_get_status()->get($this->status),
      'options' => $this->options,
    ];

    /*Transform Relation Ships*/
    if (in_array('category', $includes)) {
      $data['category'] = new CategoryTransformer($this->category);
    }
   
    if (in_array('ingredient', $includes)) {
      $data['ingredient'] = new IngredientTransformer($this->ingredient);
    }
    
    return $data;

  }
}
