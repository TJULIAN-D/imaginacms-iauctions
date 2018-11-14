<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $table = 'iauctions__products';
   
    protected $fillable = [
        'name',
        'slug',
        'unity',
        'concentration',
        'dosis_ha',
        'category_id',
        'ingredient_id',
        'status',
        'options',
    ];

    protected $fakeColumns = ['options'];

    protected $casts = [
        'options' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
    
    public function users()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsToMany("Modules\\User\\Entities\\{$driver}\\User","iauctions__userproducts")
        ->withTimestamps();
    }

    public function auctions(){
        return $this->hasMany(Auction::class);
    }

    public function auctionproviderproducts(){
        return $this->hasMany(AuctionProviderProduct::class);
    }

    public function bids(){
        return $this->hasMany(Bid::class);
    }

    protected function setSlugAttribute($value){

        if(!empty($value)){
            $this->attributes['slug'] = str_slug($value,'-');
        }else{
            $this->attributes['slug'] = str_slug($this->name,'-');
        }
       
    }

    public function getOptionsAttribute($value) {
        if(!is_string(json_decode($value))){
            return json_decode($value);
        }
        return json_decode(json_decode($value));
    }



}
