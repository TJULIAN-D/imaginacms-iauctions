<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Iauctions\Presenters\BidsPresenter;

class Bid extends Model
{
    use PresentableTrait, NamespacedEntity;

    protected $table = 'iauctions__bids';
    protected $fillable = [
        'auction_id',
        'provider_id',
        'product_id',
        'price',
        'longer_term',
        'tax',
        'freight_term',
        'freight_price',
        'total_price',
        'options',
        'code_user'
    ];

    protected $fakeColumns = ['options'];

    protected $presenter = BidsPresenter::class;
    protected $casts = [
        'options' => 'array'
    ];

    public function provider()
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

        return json_decode($value);
    }

    public function getTotalAttribute($value) {

        return $this->present()->total;
    }

}
