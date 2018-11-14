@php
	
	$opQuantity = array('min' => 0,'required' => 'required');
@endphp


{!! Form::normalInputOfType('number','longerterm', trans('iauctions::auctions.table.longerterm'), $errors,$auction,$opQuantity) !!}

{!! Form::normalInputOfType('number','financialcost_daily', trans('iauctions::auctions.table.financial cost daily'), $errors,$auction,$opQuantity) !!}

{!! Form::normalInputOfType('number','financialcost_monthly', trans('iauctions::auctions.table.financial cost monthly'), $errors,$auction,$opQuantity) !!}

{!! Form::normalInputOfType('number','longerterm_freight', trans('iauctions::auctions.table.longerterm freight'), $errors,$auction,$opQuantity) !!}