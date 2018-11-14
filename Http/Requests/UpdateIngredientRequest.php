<?php

namespace Modules\Iauctions\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateIngredientRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|min:2',
        ];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'title.required' => trans('iauctions::common.messages.title is required'),
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
