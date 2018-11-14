<div id="searchProduct">
     
    <div class="form-group">
        <select id="product_id" name="product_id" class="form-control" multiple style="width:100%;" required>
            @if(!empty($auction->product_id))
              <option value="{{$auction->product_id}}" selected>{{$auction->product->name}}</option>
            @endif
        </select>
    </div>

</div>
              
<link href="{{asset('modules/bcrud/vendor/select2/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('modules/bcrud/vendor/select2/select2-bootstrap-dick.css') }}" rel="stylesheet" type="text/css" />

@push('js-stack')

<script src="{{ asset('modules/bcrud/vendor/select2/select2.js') }}"></script>
@if(locale()=="es")
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
@endif

<script type="text/javascript">
$(function(){
  $("#product_id").each(function (i, obj) {
    if (!$(obj).hasClass("select2-hidden-accessible"))
    {
      $(obj).select2({
        theme: 'bootstrap',
        multiple: false,
        placeholder: "{{trans('iauctions::products.title.search')}}",
        minimumInputLength: "2",
        language:"{{locale()}}",

        ajax: {
          url: "{{route('admin.iauctions.product.searchAjax')}}",
          dataType: 'json',
          quietMillis: 250,
          data: function (params) {
            return {
              q: params.term, // search term
              page: params.page
            };
          },
          processResults: function (data, params) {
            params.page = params.page || 1;
            return {
              results: $.map(data.data, function (item) {
                return {
                  text: item["name"],
                  id: item["id"]
                }
              }),
              more: data.current_page < data.last_page
            };
          },
          cache: true
        },
      });
    }
  });
});
</script>


@endpush

