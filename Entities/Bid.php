<?php

namespace Modules\Iauctions\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Bid extends CrudModel
{
    use Translatable;

    protected $table = 'iauctions__bids';
    public $transformer = 'Modules\Iauctions\Transformers\BidTransformer';
    public $requestValidation = [
        'create' => 'Modules\Iauctions\Http\Requests\CreateBidRequest',
        'update' => 'Modules\Iauctions\Http\Requests\UpdateBidRequest',
      ];
    public $translatedAttributes = [];
    protected $fillable = [];
}
