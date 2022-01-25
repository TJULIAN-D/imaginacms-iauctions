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
    public $translatedAttributes = [];
    protected $fillable = [];
}
