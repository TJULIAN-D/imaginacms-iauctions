<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class AuctionTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'iauctions__auction_translations';
}
