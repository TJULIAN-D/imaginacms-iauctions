<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserProduct extends Pivot
{
   
    protected $table = 'iauctions__userproducts';
    protected $fillable = [
        'user_id',
        'product_id'
    ];

}
