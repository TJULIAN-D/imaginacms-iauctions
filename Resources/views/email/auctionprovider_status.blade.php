@extends('email.plantilla')
@section('content')
  <div id="contend-mail" class="p-3">
    @php

      $auction=$data['content']['auction'];
      $user=$data['content']['user'];
      $statusName=$data['content']['statusName'];

    @endphp
    <h3 class="text-center text-uppercase">
      {{trans('iauctions::common.email.intro.change state')}}
    </h3>
  
    <br>
    
    <p class="px-3">
      <strong>Mr/Mrs:</strong>{{$user}}
    </p>
    
    <div style="margin-bottom: 5px">
        {{trans('iauctions::common.email.msj.The status of your Auction has changed to')}}
        : <strong>{{$statusName}}</strong>
    </div>

    <div style="margin-bottom: 5px">
        {{trans('iauctions::common.table.title')}} {{trans('iauctions::auctions.single')}}:
        {{$auction["title"]}}
    </div>
  
  </div>

@endsection