<?php

namespace Modules\Iauctions\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iauctions\Entities\AuctionProvider;
use Modules\Iauctions\Http\Requests\CreateAuctionProviderRequest;
use Modules\Iauctions\Http\Requests\UpdateAuctionProviderRequest;
use Modules\Iauctions\Repositories\AuctionProviderRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

use Modules\Iauctions\Repositories\AuctionRepository;

use Modules\Iauctions\Entities\Status;

class AuctionProviderController extends AdminBaseController
{
    /**
     * @var AuctionProviderRepository
     */
    private $auctionprovider;
    private $auction;
    private $status;

    public function __construct(
        AuctionProviderRepository $auctionprovider,
        AuctionRepository $auction,
        Status $status
    ){
        parent::__construct();
        $this->auctionprovider = $auctionprovider;
        $this->auction = $auction;
        $this->status = $status;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$auctionproviders = $this->auctionprovider->all();

        return view('iauctions::admin.auctionproviders.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iauctions::admin.auctionproviders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAuctionProviderRequest $request
     * @return Response
     */
    public function store(CreateAuctionProviderRequest $request)
    {
        $this->auctionprovider->create($request->all());

        return redirect()->route('admin.iauctions.auctionprovider.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iauctions::auctionproviders.title.auctionproviders')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AuctionProvider $auctionprovider
     * @return Response
     */
    public function edit($id)
    {
        $auction = $this->auction->find($id);
        $status = $this->status;

        return view('iauctions::admin.auctionproviders.edit', compact('auction','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AuctionProvider $auctionprovider
     * @param  UpdateAuctionProviderRequest $request
     * @return Response
     */
    public function update(AuctionProvider $auctionprovider, UpdateAuctionProviderRequest $request)
    {
        //$this->auctionprovider->update($auctionprovider, $request->all());

        return redirect()->route('admin.iauctions.auctionprovider.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iauctions::auctionproviders.title.auctionproviders')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AuctionProvider $auctionprovider
     * @return Response
     */
    public function destroy(AuctionProvider $auctionprovider)
    {
        $this->auctionprovider->destroy($auctionprovider);

        return redirect()->route('admin.iauctions.auctionprovider.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iauctions::auctionproviders.title.auctionproviders')]));
    }

     /**
     * Update Status
     *
     * @param  
     * @return Response
     */
    public function updateStatus(Request $request){

        try {

            $auctionprovider = $this->auctionprovider->find($request->auctionprovider_id);
            $auctionprovider->status = $request->status;
            $auctionprovider->update();
            
          return response()->json(['success'=>1,'msg'=> trans('core::core.messages.resource updated', ['name' => trans('iauctions::auctionproviders.title.auctionproviders')])]);
        
        } catch (\Exception $e) {

          return response()->json(['success'=>0,'msg'=>$e->getMessage()]);

        }

    }

}
