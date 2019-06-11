<div id="modal-update-status" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">{{trans('iauctions::auctionproviders.title.status and products')}}</h4>
            </div>

            <div class="modal-body">

                <div class="box box-info">

                    <div class="box-header with-border">
                      <h3 class="box-title">{{trans('iauctions::common.modal.change status')}}</h3>
                    </div>

                    <div class="box-body">
                      <div class="row">
                        <div class="col-xs-6">
                            <select class="form-control" id="statusAuctionProvider" name="statusAuctionProvider">
                                @foreach ($status->lists() as $index => $statusName)
                                    <option value="{{$index}}">{{$statusName}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-6">
                            <button id="btnUpdate" name="btnUpdate" type="button" onclick="updateStatus({{$auctionprovider->id}})" class="btn btn-default btn-success" style="color:white;">
                                {{trans('iauctions::common.modal.update')}}
                            </button>
                        </div>
                        
                      </div>
                    </div>
                    
                </div>

                <div class="box box-info">

                    <div class="box-header with-border">
                      <h3 class="box-title">{{trans('iauctions::products.plural')}}</h3>
                    </div>

                    <div class="box-body">
                        <table id ="tProductsProvider"class="table table-striped">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>{{trans('iauctions::products.table.name')}}</th>
                              </tr>
                            </thead>
        
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    
                </div>

            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">
                  {{trans('iauctions::common.modal.close')}}
              </button>
            </div>

          </div>
      
        </div>
    
</div>