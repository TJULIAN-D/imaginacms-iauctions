<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $table = 'iauctions__categories';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'options'
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
        if(!is_string(json_decode($value))){
            return json_decode($value);
        }
        return json_decode(json_decode($value));
    }
    
}
