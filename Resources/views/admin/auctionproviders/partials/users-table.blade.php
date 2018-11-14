<div class="box box-success">

    <div class="box-header with-border">
        <h3 class="box-title text-uppercase ">
            <strong>{{trans('iauctions::auctionproviders.table.providers')}}</strong>
        </h3>
    
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    
    </div>

    <div class="box-body">
        <br>
        <div class="table-responsive">
                <table id="tableUsers" class="data-table table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{trans('iauctions::auctionproviders.table.fullname')}}</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($j=1;$j<4;$j++)
                        <tr>
                            <td>{{$j}}</td>
                            <td>xxxxxx xxxxxx</td>
                            <td>xxx@xxxxx.xxx</td>
                            <td>Pending</td>         
                            <td>
                                <div class="btn-group">
                                    <button title="{{trans('iauctions::auctionproviders.title.status and products')}}" onclick="editStatus()" type="button" class="btn btn-sm btn-info btn-flat">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>{{trans('iauctions::auctionproviders.table.fullname')}}</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>{{ trans('core::core.table.actions') }}</th>
                    </tr>
                    </tfoot>
                </table>
                <!-- /.box-body -->
        </div>
    </div>

</div>

@include('core::partials.delete-modal')

@push('js-stack')

<?php $locale = locale(); ?>

<script type="text/javascript">

    $(function(){ 

        $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
        });

    });

    function editStatus(){
        
      
        $.ajax({
            url:"",
            type:'POST',
            headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
            dataType:"json",
            data:{},
            success:function(result){
                if(result.success){
                
                }else{
                    console.log('Error get products: '+result.msg);
                }
            },
            error:function(error){
                console.log("ERROR AJAX EDIT STATUS: "+error);
            }
        });//ajax

        $('#modal-update-status').modal();

    }

    function updateStatus(){

       
        $.ajax({
            url:"",
            type:'POST',
            headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
            dataType:"json",
            data:{},
            success:function(result){
                if(result.success){
                   
                }else{
                    console.log('Error, update price product: '+result.msg);
                }
            },
            error:function(error){
                console.log("ERROR AJAX UPDATE STATUS: "+error);
            }
        });//ajax
       

        $('#modal-update-status').modal("hide");

    }

</script>


@endpush