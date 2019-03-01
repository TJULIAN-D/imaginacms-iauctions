<div class="box">

        <div class="box-header with-border">
            
            <h3 class="box-title text-uppercase ">
                <strong>{{trans('iauctions::auctions.single')}}</strong>
            </h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>

        </div>

        <div class="box-body">
            
            <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading text-uppercase ">
                    <strong>{{trans('iauctions::auctions.table.title')}}</strong>
                </div>
                <div class="panel-body">{{$auction->title}}</div>
            </div>
            </div>

            <div class="col-xs-8">
            <div class="panel panel-default">
                <div class="panel-heading text-uppercase">
                    <strong>{{trans('iauctions::auctions.table.description')}}</strong>
                </div>
                <div class="panel-body">{!!$auction->description!!}</div>
            </div>
            </div>

            <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading text-uppercase">
                    <strong>{{trans('iauctions::auctions.table.started_at')}}</strong>
                </div>
                <div class="panel-body">{{iauctions_format_date($auction->started_at)}}</div>
            </div>
            </div>

            <div class="col-xs-4">
            <div class="panel panel-default">
                <div class="panel-heading text-uppercase">
                    <strong>{{trans('iauctions::auctions.table.finished_at')}}</strong>
                </div>
                <div class="panel-body">{{iauctions_format_date($auction->finished_at)}}</div>
            </div>
            </div>

            <div class="col-xs-4">
                <div class="panel panel-default">
                    @php
                        $statusAuction = iauctions_get_statusAuction();
                    @endphp
                    <div class="panel-heading"><strong>STATUS</strong></div>
                    <div class="panel-body">{{$statusAuction->get($auction->status)}}</div>
                </div>
            </div>

            
            <div class="col-xs-6">
                <table class="table table-condensed table-bordered">
                    <tbody> 
                        <tr>
                            <th>{{trans('iauctions::auctions.table.base price')}}</th>
                            <td>{{$auction->base_price}}</td>
                        </tr>
                        <tr>
                            <th>{{trans('iauctions::auctions.table.quantity')}}</th>
                            <td>{{$auction->quantity}}</td>
                        </tr>
                        <tr>
                            <th>{{trans('iauctions::auctions.table.area')}}</th>
                            <td>{{$auction->area}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="col-xs-6">
                <table class="table table-condensed table-bordered">
                    <tbody> 
                        <tr>
                            <th>{{trans('iauctions::auctions.table.longerterm')}}</th>
                            <td>{{$auction->longerterm}}</td>
                        </tr>
                        <tr>
                            <th>{{trans('iauctions::auctions.table.financial cost daily')}}</th>
                            <td>{{$auction->financialcost_daily}}</td>
                        </tr>
                        <tr>
                            <th>{{trans('iauctions::auctions.table.financial cost monthly')}}</th>
                            <td>{{$auction->financialcost_monthly}}</td>
                        </tr>
                        <tr>
                            <th>{{trans('iauctions::auctions.table.longerterm freight')}}</th>
                            <td>{{$auction->longerterm_freight}}</td>
                        </tr>
    
                    </tbody>
                </table>
            </div>
        </div>
                     
</div>