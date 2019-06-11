<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    
    protected $table = 'iauctions__products';
   
    protected $fillable = [
        'name',
        'unity',
        'concentration',
        'ingredient_id',
        'status',
        'options',
    ];

    protected $fakeColumns = ['options'];

    protected $casts = [
        'options' => 'array'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
    
    public function providers()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsToMany("Modules\\User\\Entities\\{$driver}\\User","iauctions__provider_product")
        ->withTimestamps();
    }

    public function auctions(){
        return $this->hasMany(Auction::class);
    }

    public function auctionProvider(){
        return $this->belongsToMany(AuctionProvider::class, 'iauctions__auction_provider_product');
    }


    public function bids(){
        return $this->hasMany(Bid::class);
    }

    public function getOptionsAttribute($value) {

        return json_decode($value);
    }



}
