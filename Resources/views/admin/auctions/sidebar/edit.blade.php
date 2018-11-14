<div class="form-group">
        <label for="status">Status</label>
        <select class="form-control" id="status" name="status">
            @foreach ($status->lists() as $index => $ts)
                <option value="{{$index}}" @if($index==$auction->status) selected @endif >{{$ts}}</option>
            @endforeach
        </select>
</div>

<div class="form-group">
        <label>{{trans('iauctions::auctions.table.started_at')}}</label>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
        <input type="text" class="form-control pull-right datesAts" id="started_at" name="started_at">
        </div>
</div>

<div class="form-group">
        <label>{{trans('iauctions::auctions.table.finished_at')}}</label>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-clock-o"></i>
            </div>
            <input type="text" class="form-control pull-right datesAts" id="finished_at" name="finished_at">
        </div>
</div>

<link href="{{asset('modules/bcrud/vendor/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />

@push('js-stack')

<script src="{{ asset('modules/bcrud/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('modules/bcrud/vendor/daterangepicker/daterangepicker.js') }}"></script>

<script type="text/javascript">


$(function(){ 
	
	//Date range picker with time picker
    $('#started_at').daterangepicker({
        timePicker: true,
		singleDatePicker: true,
        startDate: "{{iauctions_format_date($auction->started_at)}}",
		locale: {
      		format: 'DD/MM/YYYY hh:mm A'
    	}
    });

    $('#finished_at').daterangepicker({
        timePicker: true,
		singleDatePicker: true,
        startDate: "{{iauctions_format_date($auction->finished_at)}}",
		locale: {
      		format: 'DD/MM/YYYY hh:mm A'
    	}
    });

});

</script>

@endpush