<?php

namespace Modules\Iauctions\Entities;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;
use Modules\Core\Traits\NamespacedEntity;

class ProductProvider extends Model
{
    use PresentableTrait, NamespacedEntity;
    protected $table = 'iauctions__provider_product';
    protected $fillable = ['user_id', 'product_id','status'];


}
