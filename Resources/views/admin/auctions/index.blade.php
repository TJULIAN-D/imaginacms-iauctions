@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('iauctions::auctions.title.auctions') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('iauctions::auctions.title.auctions') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.iauctions.auction.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('iauctions::auctions.button.create auction') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="data-table table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('iauctions::auctions.table.title') }}</th>
                                <th>{{ trans('iauctions::auctions.table.base price') }}</th>
                                <th>{{ trans('iauctions::auctions.table.started_at') }}</th>
                                <th>{{ trans('iauctions::auctions.table.finished_at') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($auctions)): ?>
                            <?php foreach ($auctions as $auction): ?>
                            <tr>
                                <td>{{$auction->id}}</td>
                                <td>{{$auction->title}}</td>
                                <td>{{$auction->base_price}}</td>
                                <td>{{iauctions_format_date($auction->started_at)}}</td>
                                <td>{{iauctions_format_date($auction->finished_at)}}</td>
                                <td>
                                    <a href="{{ route('admin.iauctions.auction.edit', [$auction->id]) }}">
                                        {{ $auction->created_at }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.iauctions.auction.edit', [$auction->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('admin.iauctions.auctionprovider.edit', [$auction->id]) }}" class="btn btn-default btn-flat btn-success" title="{{trans('iauctions::auctionproviders.plural')}}"><i class="fa fa-users fa-inverse"></i></a>
                                        <a href="{{ route('admin.iauctions.bid.edit', [$auction->id]) }}" class="btn btn-default btn-flat btn-warning" title="{{trans('iauctions::bids.plural')}}"><i class="fa fa-list-alt fa-inverse"></i></a>
                                        <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.iauctions.auction.destroy', [$auction->id]) }}"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>{{ trans('iauctions::auctions.table.title') }}</th>
                                <th>{{ trans('iauctions::auctions.table.base price') }}</th>
                                <th>{{ trans('iauctions::auctions.table.started_at') }}</th>
                                <th>{{ trans('iauctions::auctions.table.finished_at') }}</th>
                                <th>{{ trans('core::core.table.created at') }}</th>
                                <th>{{ trans('core::core.table.actions') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                        <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('iauctions::auctions.title.create auction') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.iauctions.auction.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
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
    </script>
@endpush
