<?php

namespace Modules\Iauctions\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateAuctionProviderRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'auction_id'=>'required',
            'provider_id'=>'required',
            'status'=>'required'
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
            'auction_id.required' => trans('iauctions::autionproviders.messages.Auction is required'),
            'provider_id.required' => trans('iauctions::autionproviders.messages.Provider is required'),
            'status.required' => trans('iauctions::autionproviders.messages.Status is required'),

        ];
    }

    public function translationMessages()
    {
        return [];
    }
}
