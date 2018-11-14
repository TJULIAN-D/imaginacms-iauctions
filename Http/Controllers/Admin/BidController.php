<?php

namespace Modules\Iauctions\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iauctions\Entities\Bid;
use Modules\Iauctions\Http\Requests\CreateBidRequest;
use Modules\Iauctions\Http\Requests\UpdateBidRequest;
use Modules\Iauctions\Repositories\BidRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

use Modules\Iauctions\Repositories\AuctionRepository;

use Modules\Iauctions\Entities\Status;

class BidController extends AdminBaseController
{
    /**
     * @var BidRepository
     */
    private $bid;
    private $auction;
    private $status;

    public function __construct(
        BidRepository $bid,
        AuctionRepository $auction,
        Status $status
    ){
        parent::__construct();
        $this->bid = $bid;
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
        //$bids = $this->bid->all();

        return view('iauctions::admin.bids.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iauctions::admin.bids.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBidRequest $request
     * @return Response
     */
    public function store(CreateBidRequest $request)
    {
        $this->bid->create($request->all());

        return redirect()->route('admin.iauctions.bid.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iauctions::bids.title.bids')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Bid $bid
     * @return Response
     */
    public function edit($id)
    {
        $auction = $this->auction->find($id);
        $status = $this->status;
        return view('iauctions::admin.bids.edit', compact('auction','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Bid $bid
     * @param  UpdateBidRequest $request
     * @return Response
     */
    public function update(Bid $bid, UpdateBidRequest $request)
    {
        $this->bid->update($bid, $request->all());

        return redirect()->route('admin.iauctions.bid.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iauctions::bids.title.bids')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bid $bid
     * @return Response
     */
    public function destroy(Bid $bid)
    {
        $this->bid->destroy($bid);

        return redirect()->route('admin.iauctions.bid.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iauctions::bids.title.bids')]));
    }
}
