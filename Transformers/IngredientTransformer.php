<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class IngredientTransformer extends Resource
{
  public function toArray($request)
  {

    /*Values to return*/
    return [
      'id' => $this->id, 
      'title' => $this->title,
      'slug' => $this->slug,
      'options' => $this->options
    ];

  }
}
