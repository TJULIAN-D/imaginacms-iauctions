<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
   
    protected $table = 'iauctions__auctions';
   
    protected $fillable = [
        'title',
        'description',
        'base_price',
        'started_at',
        'finished_at',
        'quantity',
        'area',
        'longer_term',
        'financial_cost_daily',
        'financial_cost_monthly',
        'longer_term_freight',
        'product_id',
        'ingredient_id',
        'status',
        'user_id',
        'winner_id',
        'winner_value',
        'options',

    ];

    protected $fakeColumns = ['options'];

    protected $casts = [
        'options' => 'array'
    ];

    public function user()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    public function product()
    {
        return $this->belongsTo("Modules\Iauctions\Entities\Product");
    }
    public function ingredient()
    {
        return $this->belongsTo("Modules\Iauctions\Entities\Ingredient");
    }

    public function auctionProviders()
    {
        return $this->hasMany(AuctionProvider::class);
    }

    public function bid()
    {
        return $this->hasMany(Bid::class);
    }

    public function getOptionsAttribute($value) {

        return json_decode($value);
    }
    


}
