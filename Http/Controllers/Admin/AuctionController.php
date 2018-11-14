<?php

namespace Modules\Iauctions\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iauctions\Entities\Auction;
use Modules\Iauctions\Http\Requests\CreateAuctionRequest;
use Modules\Iauctions\Http\Requests\UpdateAuctionRequest;
use Modules\Iauctions\Repositories\AuctionRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Iauctions\Entities\StatusAuction;

use Modules\User\Contracts\Authentication;
use Modules\User\Repositories\UserRepository;

use Carbon\Carbon;

class AuctionController extends AdminBaseController
{
    /**
     * @var AuctionRepository
     */
    private $auction;
    private $status;
    private $user;
    protected $auth;

    public function __construct(
        AuctionRepository $auction,
        StatusAuction $status,
        Authentication $auth,
        UserRepository $user
    ){
        parent::__construct();

        $this->auction = $auction;
        $this->status = $status;
        $this->user = $user;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $auctions = $this->auction->all();
        return view('iauctions::admin.auctions.index', compact('auctions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $status = $this->status;
        return view('iauctions::admin.auctions.create',compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAuctionRequest $request
     * @return Response
     */
    public function store(CreateAuctionRequest $request)
    {
        
        $user = $this->auth->user();
        $dateTime = Carbon::createFromFormat('d/m/Y g:ia', $request->started_at);
        $dateTime2 = Carbon::createFromFormat('d/m/Y g:ia', $request->finished_at);
       
        $request->merge(['user_id' => $user->id]);
        $request->merge(['started_at' => $dateTime]);
        $request->merge(['finished_at' => $dateTime2]);
        
        $this->auction->create($request->all());

        return redirect()->route('admin.iauctions.auction.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iauctions::auctions.title.auctions')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Auction $auction
     * @return Response
     */
    public function edit(Auction $auction)
    {
        $status = $this->status;
        return view('iauctions::admin.auctions.edit', compact('auction','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Auction $auction
     * @param  UpdateAuctionRequest $request
     * @return Response
     */
    public function update(Auction $auction, UpdateAuctionRequest $request)
    {

        $dateTime = Carbon::createFromFormat('d/m/Y g:ia', $request->started_at);
        $dateTime2 = Carbon::createFromFormat('d/m/Y g:ia', $request->finished_at);
       
        $request->merge(['started_at' => $dateTime]);
        $request->merge(['finished_at' => $dateTime2]);

        $this->auction->update($auction, $request->all());

        return redirect()->route('admin.iauctions.auction.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iauctions::auctions.title.auctions')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Auction $auction
     * @return Response
     */
    public function destroy(Auction $auction)
    {
        $this->auction->destroy($auction);

        return redirect()->route('admin.iauctions.auction.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iauctions::auctions.title.auctions')]));
    }
}
