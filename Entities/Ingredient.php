<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
   
    protected $table = 'iauctions__ingredients';
    protected $fillable = [
        'title',
        'slug',
        'options', 
    ];

    protected $fakeColumns = ['options'];

    protected $casts = [
        'options' => 'array'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected function setSlugAttribute($value){

        if(!empty($value)){
            $this->attributes['slug'] = str_slug($value,'-');
        }else{
            $this->attributes['slug'] = str_slug($this->title,'-');
        }
       
    }

    public function getOptionsAttribute($value) {
         return json_decode($value);
    }


}