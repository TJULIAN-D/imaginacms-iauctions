<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    
    protected $table = 'iauctions__bids';
    protected $fillable = [
        'auction_id',
        'user_id',
        'product_id',
        'price',
        'longerterm',
        'tax',
        'freight_term',
        'freight_price',
        'total_price',
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

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function getOptionsAttribute($value) {
        if(!is_string(json_decode($value))){
            return json_decode($value);
        }
        return json_decode(json_decode($value));
    }



}
