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
        'longerterm',
        'financialcost_daily',
        'financialcost_monthly',
        'longerterm_freight',
        'product_id',
        'status', 
        'user_id',
        'winner_id',
        'options'
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

    public function auctionproviders()
    {
        return $this->hasMany(AuctionProvider::class);
    }

    public function bid()
    {
        return $this->hasMany(AuctionProvider::class);
    }

    public function getOptionsAttribute($value) {
        if(!is_string(json_decode($value))){
            return json_decode($value);
        }
        return json_decode(json_decode($value));
    }
    


}
