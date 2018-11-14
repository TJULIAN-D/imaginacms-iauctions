<?php

namespace Modules\Iauctions\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iauctions\Entities\UserProduct;
use Modules\Iauctions\Http\Requests\CreateUserProductRequest;
use Modules\Iauctions\Http\Requests\UpdateUserProductRequest;
use Modules\Iauctions\Repositories\UserProductRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class UserProductController extends AdminBaseController
{
    /**
     * @var UserProductRepository
     */
    private $userproduct;

    public function __construct(UserProductRepository $userproduct)
    {
        parent::__construct();

        $this->userproduct = $userproduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$userproducts = $this->userproduct->all();

        return view('iauctions::admin.userproducts.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iauctions::admin.userproducts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateUserProductRequest $request
     * @return Response
     */
    public function store(CreateUserProductRequest $request)
    {
        $this->userproduct->create($request->all());

        return redirect()->route('admin.iauctions.userproduct.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iauctions::userproducts.title.userproducts')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UserProduct $userproduct
     * @return Response
     */
    public function edit(UserProduct $userproduct)
    {
        return view('iauctions::admin.userproducts.edit', compact('userproduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserProduct $userproduct
     * @param  UpdateUserProductRequest $request
     * @return Response
     */
    public function update(UserProduct $userproduct, UpdateUserProductRequest $request)
    {
        $this->userproduct->update($userproduct, $request->all());

        return redirect()->route('admin.iauctions.userproduct.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iauctions::userproducts.title.userproducts')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UserProduct $userproduct
     * @return Response
     */
    public function destroy(UserProduct $userproduct)
    {
        $this->userproduct->destroy($userproduct);

        return redirect()->route('admin.iauctions.userproduct.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iauctions::userproducts.title.userproducts')]));
    }
}
