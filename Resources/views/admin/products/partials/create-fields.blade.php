@php
	$op = array('required' => 'required');
    $opInt = array('min' => 0,'required' => 'required');
    $opFloat = array('step' => '0.01','min' => 0,'required' => 'required');
@endphp


<div class="box-body">

    <div class="col-xs-7 column-left">

        {!! Form::normalInput('name',trans('iauctions::products.table.name'), $errors,null,$op) !!}
            
        {!! Form::normalInput('slug',trans('iauctions::products.table.slug'), $errors) !!}
        
        <div class="form-group">
            <label for="unity">{{trans('iauctions::products.table.unity')}}</label>
            <select class="form-control" id="unity" name="unity" required>
                @foreach ($unity->lists() as $index => $ts)
                        <option value="{{$index}}" @if($index==0) selected @endif >{{$ts}}</option>
                @endforeach
            </select>
        </div>
       
        {!! Form::normalInputOfType('number','concentration', trans('iauctions::products.table.concentration'), $errors,null,$opFloat) !!}

        {!! Form::normalInputOfType('number','dosis_ha', trans('iauctions::products.table.dosis_ha'), $errors,null,$opFloat) !!}

    </div>

    <div class="col-xs-5 column-right">

        <div class="form-group">
            <label for="ingredient">{{trans('iauctions::ingredients.single')}}</label>
            <select class="form-control" id="ingredient_id" name="ingredient_id" required>
                @foreach ($ingredients as $index => $ingredient)
                    <option value="{{$ingredient->id}}" @if($index==0) selected @endif >{{$ingredient->title}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category">{{trans('iauctions::categories.single')}}</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach ($categories as $index => $category)
                    <option value="{{$category->id}}" @if($index==0) selected @endif >{{$category->title}}</option>
                @endforeach
            </select>
        </div>
       
    </div>

    <div class="col-xs-12 column-botton">
        
        @include('iauctions::admin.products.partials.notes')

    </div>

</div>
