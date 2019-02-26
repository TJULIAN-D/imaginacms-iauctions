<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class IngredientTransformer extends Resource
{
    public function toArray($request)
    {

        /*Values to return*/
        return [
            'id' => $this->when($this->id, $this->id),
            'title' => $this->when($this->title, $this->title),
            'options' => $this->when($this->options, $this->options),
            'products'=>ProductTransformer::collection($this->whenLoaded('products')),
        ];

    }
}
