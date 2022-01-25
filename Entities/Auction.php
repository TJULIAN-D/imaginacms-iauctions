<?php

namespace Modules\Iauctions\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Auction extends CrudModel
{
    use Translatable;

    protected $table = 'iauctions__auctions';
    public $transformer = 'Modules\Iauctions\Transformers\AuctionTransformer';
    public $requestValidation = [
        'create' => 'Modules\Iauctions\Http\Requests\CreateAuctionRequest',
        'update' => 'Modules\Iauctions\Http\Requests\UpdateAuctionRequest',
      ];
    public $translatedAttributes = [];
    protected $fillable = [];
}
