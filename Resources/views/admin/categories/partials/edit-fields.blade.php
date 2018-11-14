@php
	$op = array('required' => 'required');
@endphp

<div class="box-body">
    
    <div class="col-xs-10 column-left">

        {!! Form::normalInput('title',trans('iauctions::categories.table.title'), $errors,$category,$op) !!}
        
        {!! Form::normalInput('slug',trans('iauctions::categories.table.slug'), $errors,$category) !!}
    
        {!! Form:: normalTextarea('description', trans('iauctions::categories.table.description'), $errors,$category,$op) !!} 

    </div>

</div>
