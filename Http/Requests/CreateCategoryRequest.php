<?php

namespace Modules\Iauctions\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

use Modules\Iauctions\Rules\ValidatePath;

class CreateCategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'system_name' => 'required',
            'bid_service' => new ValidatePath 
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
        return [];
    }

    public function translationMessages()
    {
        return [
            'title.required' => trans('iauctions::common.messages.field required'),
            'system_name.required' => trans('iauctions::common.messages.field required'),
        ];
    }

    public function getValidator(){
        return $this->getValidatorInstance();
    }
    
}
