<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class CategoryTransformer extends Resource
{
  public function toArray($request)
  {

    /*Values to return*/
    return [
      'id' => $this->id, 
      'title' => $this->title,
      'slug' => $this->slug,
      'description' => $this->description,
      'options' => $this->options
    ];

  }
}
