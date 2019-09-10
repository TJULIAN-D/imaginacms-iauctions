<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Iauctions\Presenters\AuctionsPresenter;

class Auction extends Model
{

    use PresentableTrait, NamespacedEntity;

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
        'product_unit',
        'status',
        'user_id',
        'place_delivery',
        'date_delivery',
        'winner_id',
        'winner_value',
        'options',

    ];

    protected $fakeColumns = ['options'];

    protected $presenter = AuctionsPresenter::class;
    protected $casts = [
        'options' => 'array'
    ];

    /**
     * @return mixed
     */
    public function user()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
    }

    /**
     * @return mixed
     */
    public function product()
    {
        return $this->belongsTo("Modules\Iauctions\Entities\Product");
    }

    /**
     * @return mixed
     */
    public function ingredient()
    {
        return $this->belongsTo("Modules\Iauctions\Entities\Ingredient");
    }

    /**
     * @return mixed
     */
    public function auctionProviders()
    {
        return $this->hasMany(AuctionProvider::class);
    }

    /**
     * @return mixed
     */
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * @return mixed
     */
    public function winner()
    {
        return $this->belongsTo(Bid::class,'winner_id');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getOptionsAttribute($value) {

        return json_decode($value);
    }

    /**
     * Check if the post is in draft
     * @param Builder $query
     * @return Builder
     */
    public function scopeApproved(Builder $query)
    {
        return $query->whereStatus(Status::APPROVED);
    }


}
