<?php

namespace Modules\Iauctions\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ProductTransformer extends Resource
{
    public function toArray($request)
    {

        $data = [

            'id' => $this->when($this->id, $this->id),
            'name' => $this->when($this->name, $this->name),
            'unity' => $this->when($this->unity, $this->unity),
            'unityName' => $this->when($this->unity, iauctions_get_unity()->get($this->unity)),
            'concentration' => $this->when($this->concentration, $this->concentration),
            'dosis_ha' => $this->when($this->dosis_ha, $this->dosis_ha),
            'status' => $this->when($this->status, $this->status),
            'options' =>$this->when($this->options, $this->options),
            'ingredient_id' =>$this->when($this->ingredient_id, $this->ingredient_id),
            'ingredient'=> new IngredientTransformer($this->whenLoaded('ingredient')),
        ];

        return $data;

    }
}
