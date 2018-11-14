<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class AuctionProviderProduct extends Model
{

    protected $table = 'iauctions__auctionproviderproducts';
    protected $fillable = [
        'auctionprovider_id',
        'product_id'
    ];

    public function auctionprovider()
    {
        return $this->belongsTo(AuctionProvider::class);
    }

    public function product()
    {
        return $this->belongsTo("Modules\Iauctions\Entities\Product");
    }

    

}

