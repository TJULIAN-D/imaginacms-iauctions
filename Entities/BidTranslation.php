<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;

class BidTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'iauctions__bid_translations';
}
