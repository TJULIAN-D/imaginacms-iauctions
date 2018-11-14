@php
	$op = array('required' => 'required');
	$opPrice = array('step' => '0.01','min' => 0);
	$opQuantity = array('min' => 0,'required' => 'required');
@endphp

{!! Form::normalInput('title',trans('iauctions::auctions.table.title'), $errors,$auction,$op) !!}

{!! Form:: normalTextarea('description', trans('iauctions::auctions.table.description'), $errors,$auction,$op) !!} 

{!! Form::normalInputOfType('number','base_price', trans('iauctions::auctions.table.base price'), $errors,$auction,$opPrice) !!}

{!! Form::normalInputOfType('number','quantity', trans('iauctions::auctions.table.quantity'), $errors,$auction,$opQuantity) !!}

{!! Form::normalInputOfType('number','area', trans('iauctions::auctions.table.area'), $errors,$auction,$opQuantity) !!}