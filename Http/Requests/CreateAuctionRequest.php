<?php

namespace Modules\Iauctions\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateAuctionRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'department_id' => 'required',
            'category_id' => 'required',
            'end_at' => 'after:start_at'
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
            'description.required' => trans('iauctions::common.messages.field required'),
            'user_id.required' => trans('iauctions::common.messages.field required'),
            'department_id.required' => trans('iauctions::common.messages.field required'),
            'category_id.required' => trans('iauctions::common.messages.field required')
        ];
    }

    public function getValidator(){
        return $this->getValidatorInstance();
    }
    
}
