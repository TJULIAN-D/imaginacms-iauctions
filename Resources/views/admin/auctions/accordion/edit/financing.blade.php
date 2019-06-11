@php
	
	$opQuantity = array('min' => 0,'required' => 'required');
@endphp


{!! Form::normalInputOfType('number','longer_term', trans('iauctions::auctions.table.longerterm'), $errors,$auction,$opQuantity) !!}

{!! Form::normalInputOfType('number','financial_cost_daily', trans('iauctions::auctions.table.financial cost daily'), $errors,$auction,$opQuantity) !!}

{!! Form::normalInputOfType('number','financial_cost_monthly', trans('iauctions::auctions.table.financial cost monthly'), $errors,$auction,$opQuantity) !!}

{!! Form::normalInputOfType('number','longer_term_freight', trans('iauctions::auctions.table.longerterm freight'), $errors,$auction,$opQuantity) !!}