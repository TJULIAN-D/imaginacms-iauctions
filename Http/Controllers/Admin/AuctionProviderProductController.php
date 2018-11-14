<?php

namespace Modules\Iauctions\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iauctions\Entities\AuctionProviderProduct;
use Modules\Iauctions\Http\Requests\CreateAuctionProviderProductRequest;
use Modules\Iauctions\Http\Requests\UpdateAuctionProviderProductRequest;
use Modules\Iauctions\Repositories\AuctionProviderProductRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class AuctionProviderProductController extends AdminBaseController
{
    /**
     * @var AuctionProviderProductRepository
     */
    private $auctionproviderproduct;

    public function __construct(AuctionProviderProductRepository $auctionproviderproduct)
    {
        parent::__construct();

        $this->auctionproviderproduct = $auctionproviderproduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$auctionproviderproducts = $this->auctionproviderproduct->all();

        return view('iauctions::admin.auctionproviderproducts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iauctions::admin.auctionproviderproducts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateAuctionProviderProductRequest $request
     * @return Response
     */
    public function store(CreateAuctionProviderProductRequest $request)
    {
        $this->auctionproviderproduct->create($request->all());

        return redirect()->route('admin.iauctions.auctionproviderproduct.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iauctions::auctionproviderproducts.title.auctionproviderproducts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  AuctionProviderProduct $auctionproviderproduct
     * @return Response
     */
    public function edit(AuctionProviderProduct $auctionproviderproduct)
    {
        return view('iauctions::admin.auctionproviderproducts.edit', compact('auctionproviderproduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  AuctionProviderProduct $auctionproviderproduct
     * @param  UpdateAuctionProviderProductRequest $request
     * @return Response
     */
    public function update(AuctionProviderProduct $auctionproviderproduct, UpdateAuctionProviderProductRequest $request)
    {
        $this->auctionproviderproduct->update($auctionproviderproduct, $request->all());

        return redirect()->route('admin.iauctions.auctionproviderproduct.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iauctions::auctionproviderproducts.title.auctionproviderproducts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  AuctionProviderProduct $auctionproviderproduct
     * @return Response
     */
    public function destroy(AuctionProviderProduct $auctionproviderproduct)
    {
        $this->auctionproviderproduct->destroy($auctionproviderproduct);

        return redirect()->route('admin.iauctions.auctionproviderproduct.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iauctions::auctionproviderproducts.title.auctionproviderproducts')]));
    }
}
