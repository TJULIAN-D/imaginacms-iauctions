<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;
use Modules\Iauctions\Presenters\AuctionsProviderPresenter;

class AuctionProvider extends Model
{

    use PresentableTrait, NamespacedEntity;

    protected $table = 'iauctions__auction_provider';
    protected $fillable = [
        'auction_id',
        'provider_id',
        'status',
        'code_user'
    ];

     protected $presenter = AuctionsProviderPresenter::class;

    public function provider()
    {
        $driver = config('asgard.user.config.driver');
        return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User",'provider_id');
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'iauctions__auction_provider_product')->withPivot('status');
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

