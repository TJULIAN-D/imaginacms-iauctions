@extends('layouts.master')

@section('title')
 title | @parent
@stop


@section('content')


<div class="iauctions-body container mb-5">
  

</div>

@stop

@section('scripts')
@parent

{!!Theme::script('js/app.js?v='.config('app.version'))!!}

<script type="text/javascript">



</script>

@stop