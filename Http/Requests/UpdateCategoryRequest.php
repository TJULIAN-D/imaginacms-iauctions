<?php

namespace Modules\Iauctions\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|min:2',
            'description' => 'required|min:2',
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
            'description.required' => trans('iauctions::common.messages.description is required'),
        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
