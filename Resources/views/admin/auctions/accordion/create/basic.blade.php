@php
	$op = array('required' => 'required');
	$opPrice = array('step' => '0.01','min' => 0);
	$opQuantity = array('min' => 0,'required' => 'required');
@endphp

{!! Form::normalInput('title',trans('iauctions::auctions.table.title'), $errors,null,$op) !!}

{!! Form:: normalTextarea('description', trans('iauctions::auctions.table.description'), $errors,null,$op) !!} 

{!! Form::normalInputOfType('number','base_price', trans('iauctions::auctions.table.base price'), $errors,null,$opPrice) !!}

{!! Form::normalInputOfType('number','quantity', trans('iauctions::auctions.table.quantity'), $errors,null,$opQuantity) !!}

{!! Form::normalInputOfType('number','area', trans('iauctions::auctions.table.area'), $errors,null,$opQuantity) !!}