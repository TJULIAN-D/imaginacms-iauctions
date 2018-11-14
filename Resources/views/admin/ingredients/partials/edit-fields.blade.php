@php
	$op = array('required' => 'required');
@endphp

<div class="box-body">
    
    <div class="col-xs-10 column-left">

        {!! Form::normalInput('title',trans('iauctions::categories.table.title'), $errors,$ingredient,$op) !!}
        
        {!! Form::normalInput('slug',trans('iauctions::categories.table.slug'), $errors,$ingredient) !!}
    
    </div>

</div>
