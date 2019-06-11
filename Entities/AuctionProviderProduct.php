<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class AuctionProviderProduct extends Model
{

    protected $table = 'iauctions__auction_provider_product';
    protected $fillable = [
        'auction_provider_id',
        'product_id',
        'status'
    ];

    public function auctionProvider()
    {
        return $this->belongsTo(AuctionProvider::class);
    }

    public function product()
    {
        return $this->belongsTo("Modules\Iauctions\Entities\Product");
    }

}

