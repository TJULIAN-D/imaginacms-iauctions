<?php

namespace Modules\Iauctions\Entities;

use Modules\Core\Icrud\Entities\CrudModel;
use Modules\Ifillable\Traits\isFillable;

//Static Classes
use Modules\Iauctions\Entities\StatusBid;

//Traits
use Modules\Iauctions\Traits\Notificable;

class Bid extends CrudModel
{
  
  use isFillable, Notificable;
  
  protected $table = 'iauctions__bids';
  public $transformer = 'Modules\Iauctions\Transformers\BidTransformer';
  public $requestValidation = [
    'create' => 'Modules\Iauctions\Http\Requests\CreateBidRequest',
    'update' => 'Modules\Iauctions\Http\Requests\UpdateBidRequest',
  ];
  
  protected $fillable = [
    'auction_id',
    'provider_id',
    'description',
    'amount',
    'points',
    'status',
    'winner',
    'options'
  ];
  
  protected $casts = ['options' => 'array'];
  
  
  //============== RELATIONS ==============//
  
  public function auction()
  {
    return $this->belongsTo(Auction::class);
  }
  
  public function provider()
  {
    $driver = config('asgard.user.config.driver');
    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User");
  }
  
  public function winner()
  {
    $driver = config('asgard.user.config.driver');
    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User", "winner");
  }
  
  //============== MUTATORS / ACCESORS ==============//
  
  public function setOptionsAttribute($value)
  {
    $this->attributes['options'] = json_encode($value);
  }
  
  public function getOptionsAttribute($value)
  {
    return json_decode($value);
  }
  
  public function getStatusNameAttribute()
  {
    $status = new StatusBid();
    return $status->get($this->status);
  }
  
  
}
