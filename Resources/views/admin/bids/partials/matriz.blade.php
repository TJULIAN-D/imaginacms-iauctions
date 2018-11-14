<div class="box box-warning">

    <div class="box-header with-border">
            
        <h3 class="box-title text-uppercase ">
            <strong>{{trans('iauctions::bids.plural')}}</strong>
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

            <table id="tableBids" class="data-table table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>
                        <th>{{trans('iauctions::bids.table.provider')}}</th>
                        <th>{{trans('iauctions::bids.table.longerterm')}}</th>
                        <th>{{trans('iauctions::bids.table.price')}}</th>
                        <th>{{trans('iauctions::bids.table.freight term')}}</th>
                        <th>{{trans('iauctions::bids.table.freight price')}}</th>
                        <th>{{trans('iauctions::bids.table.financial')}}</th>
                        <th>{{trans('iauctions::bids.table.total value')}}</th>
                        <th>Uni{{-- $auction->options->unit --}}</th>
                        <th>VG GR I.A</th>
                        <th>Dosis/Ha</th>
                        <th>Costo/Ha</th>
                        <th>{{trans('iauctions::auctions.table.area')}} (has)</th>
                        <th>{{trans('iauctions::bids.table.cant to buy')}}</th>
                        <th>{{trans('iauctions::products.table.concentration')}}</th>
                        <th>{{trans('iauctions::bids.table.total price')}}</th>
                        <th>{{trans('iauctions::bids.table.tax')}}</th>
                        <th>Valor IVA</th>
                        <th>Costo Total de Compra</th> 
                    </tr>
                    </thead>
                    <tbody>
                    @for($x=0;$x<10;$x++)
                        <tr>
                                <td>xxxxxx</td>
                                <td>xx</td>
                                <td>xx.xxx</td>
                                <td>xx</td>
                                <td>xx</td>
                                <td>
                                    xx.xxx
                                    {{--
                                     $finan = (($auction->options->term - $bid->options->term) * ($auction->options->financial_cost_daily) / 100) * $bid->price;
                                    --}}
                                </td>
                                <td>
                                    xx.xxx
                                    {{--
                                    $total = $bid->price + $finan;
                                    --}}
                                </td>
                                <td>
                                    xxx
                                    {{--
                                    $bid->options->quantity
                                    --}}
                                </td>
                                <td>???</td>
                                <td>
                                    x,xxx
                                    {{--
                                    $dosage = $auction->options->quantity / $auction->options->area;
                                    --}}
                                </td>
                                <td>
                                    xx.xxx
                                    {{--
                                    $cost_has = $total * $dosage;
                                    --}}
                                </td>
                                <td>xxx</td>
                                <td>
                                    x.xxx
                                    {{--
                                     $qty_des = $dosage * $auction->options->area;
                                    --}}
                                </td>
                                <td>
                                    xxx
                                </td>
                                <td>
                                    xx.xxx.xxx
                                    {{--
                                        $tcost = $total * $qty_des;
                                    --}}
                                </td>
                                <td>xxx</td>
                                <td>xxx</td>
                            <td>00.000.00{{$x}}</td>
                        </tr>
                    @endfor
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>{{trans('iauctions::bids.table.provider')}}</th>
                        <th>{{trans('iauctions::bids.table.longerterm')}}</th>
                        <th>{{trans('iauctions::bids.table.price')}}</th>
                        <th>{{trans('iauctions::bids.table.freight term')}}</th>
                        <th>{{trans('iauctions::bids.table.freight price')}}</th>
                        <th>{{trans('iauctions::bids.table.financial')}}</th>
                        <th>{{trans('iauctions::bids.table.total value')}}</th>
                        <th>Uni{{-- $auction->options->unit --}}</th>
                        <th>VG GR I.A</th>
                        <th>Dosis/Ha</th>
                        <th>Costo/Ha</th>
                        <th>{{trans('iauctions::auctions.table.area')}} (has)</th>
                        <th>{{trans('iauctions::bids.table.cant to buy')}}</th>
                        <th>{{trans('iauctions::products.table.concentration')}}</th>
                        <th>{{trans('iauctions::bids.table.total price')}}</th>
                        <th>{{trans('iauctions::bids.table.tax')}}</th>
                        <th>Valor IVA</th>
                        <th>Costo Total de Compra</th> 
                    </tr>
                    </tfoot>
            </table>
              
        </div>

    </div>

</div>

<h3 class="bg-danger">Informacion Faltante</h3>
<ul>
    <li>Solicitar calculos de la Matriz</li>
</ul>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">

@push('js-stack')

<?php $locale = locale(); ?>

<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>


<script type="text/javascript">

    $(function(){ 

        $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "pageLength": 20,
                "filter": true,
                "sort": true,
                "info": true,
                "order": [[ 11, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                },
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'colvis',
                        collectionLayout: 'fixed two-column'
                    },
                    {
                        extend: 'excel',
                        filename: 'Bid - Data export',
                        title: 'Bid - Data export',
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        filename: 'Bid - Data export',
                        title: 'Bid - Data export',
                    }
                ],
                "columnDefs": [
                    {"targets": [5],"visible": false},
                    {"targets": [6],"visible": false},
                    {"targets": [7],"visible": false},
                    {"targets": [8],"visible": false},
                    {"targets": [9],"visible": false},
                    {"targets": [10],"visible": false},
                    {"targets": [11],"visible": false},
                    {"targets": [12],"visible": false},
                ]
        });

    });

   
</script>


@endpush