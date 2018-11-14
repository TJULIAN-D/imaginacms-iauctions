<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class AuctionProvider extends Model
{

    protected $table = 'iauctions__auctionproviders';
    protected $fillable = [
        'auction_id',
        'user_id',
        'status'
    ];

    public function user()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function auctionproviderproducts()
    {
        return $this->hasMany(AuctionProviderProduct::class);
    }



}

