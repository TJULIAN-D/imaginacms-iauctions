<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  @includeFirst(['emails.style', 'iauctions::emails.base.style'])

</head>

<body>
<div id="body">
  <div id="template-mail">

    @includeFirst(['emails.header', 'iauctions::emails.base.header'])

    {{-- ***** Order Content  ***** --}}
    <div id="contend-mail" class="p-3">

        <h3 class="text-center text-uppercase">
            {{trans('iauctions::common.email.intro.change state')}}
        </h3>

        <br>

        <p class="px-3">
            <strong>Mr/Mrs:</strong>{{$user->first_name}} {{$user->last_name}}
        </p>

        <div style="margin-bottom: 5px">
            {{trans('iauctions::common.email.msj.The status of your Auction has changed to')}}
            : <strong>{{$statusName}}</strong>
        </div>

        <div style="margin-bottom: 5px">
            {{trans('iauctions::common.table.title')}} {{trans('iauctions::auctions.single')}}:
            {{$auction->title}}
        </div>

    </div>


    @includeFirst(['emails.footer', 'iauctions::emails.base.footer'])


  </div>
</div>
</body>

</html>