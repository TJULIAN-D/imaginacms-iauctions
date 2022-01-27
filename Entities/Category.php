<?php

namespace Modules\Iauctions\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Category extends CrudModel
{
    use Translatable;

    protected $table = 'iauctions__categories';
    public $transformer = 'Modules\Iauctions\Transformers\CategoryTransformer';
    public $requestValidation = [
        'create' => 'Modules\Iauctions\Http\Requests\CreateCategoryRequest',
        'update' => 'Modules\Iauctions\Http\Requests\UpdateCategoryRequest',
      ];
    public $translatedAttributes = [
        'title'
    ];
    protected $fillable = [
        'system_name',
        'bid_service',
        'options',
        'auction_form_id',
        'bid_form_id'
    ];

    protected $casts = ['options' => 'array'];
    
    //============== RELATIONS ==============//
    
    public function auctions()
    {
        return $this->hasMany(Auction::class);
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

}
