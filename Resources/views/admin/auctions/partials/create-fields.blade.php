@php
	$op = array('required' => 'required');
	
@endphp

<div class="box-body">
    
    <div class="row">

        <div class="col-sm-8">

            <div class="box box-solid">

                <div class="box-body">
                    
                    <div class="box-group" id="accordion">
                          <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel box box-primary">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                                    {{trans('iauctions::auctions.title.basic data')}}
                                </a>
                              </h4>
                            </div>

                            <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true" style="">
                                <div class="box-body">
                                   @include('iauctions::admin.auctions.accordion.create.basic')
                                </div>
                            </div>
                        </div>

                        <div class="panel box box-danger">
                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                                    {{trans('iauctions::auctions.title.financing and shipping')}}
                                </a>
                              </h4>
                            </div>

                            <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="box-body">
                                    @include('iauctions::admin.auctions.accordion.create.financing')
                                </div>
                            </div>
                        </div>

                        <div class="panel box box-success">

                            <div class="box-header with-border">
                              <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                                    {{trans('iauctions::auctions.title.product')}}
                                </a>
                              </h4>
                            </div>

                            <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                              <div class="box-body">
                                    @include('iauctions::admin.auctions.accordion.create.product')
                              </div>
                            </div>

                        </div>

                    </div>

                </div> <!-- /.box-body -->
                     
            </div> <!-- /.box -->
                   
        </div><!-- /.col -->

        <div class="col-sm-4">

            @include('iauctions::admin.auctions.sidebar.create') 

        </div>

    
    </div><!-- /.row -->

   
</div>