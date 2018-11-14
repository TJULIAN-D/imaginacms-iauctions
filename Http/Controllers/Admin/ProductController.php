<?php

namespace Modules\Iauctions\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

use Modules\Iauctions\Entities\Product;
use Modules\Iauctions\Http\Requests\CreateProductRequest;
use Modules\Iauctions\Http\Requests\UpdateProductRequest;
use Modules\Iauctions\Repositories\ProductRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

use Modules\User\Contracts\Authentication;
use Modules\User\Repositories\UserRepository;

use Modules\Iauctions\Repositories\CategoryRepository;
use Modules\Iauctions\Repositories\IngredientRepository;

use Modules\Iauctions\Entities\Unity;

class ProductController extends AdminBaseController
{
    /**
     * @var ProductRepository
     */
    private $product;
    private $user;
    protected $auth;
    private $category;
    private $ingredient;
    private $unity;

    public function __construct(
        ProductRepository $product,
        Authentication $auth, 
        UserRepository $user,
        CategoryRepository $category,
        IngredientRepository $ingredient,
        Unity $unity
    ){

        parent::__construct();
        $this->product = $product;
        $this->user = $user;
        $this->auth = $auth;
        $this->category = $category;
        $this->ingredient = $ingredient;
        $this->unity = $unity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->product->allWithRelations();
        return view('iauctions::admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {   
        $categories = $this->category->all();
        $ingredients = $this->ingredient->all();
        $unity = $this->unity;
        return view('iauctions::admin.products.create',compact('categories','ingredients','unity'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest $request
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {

        $this->product->create($request->all());
        return redirect()->route('admin.iauctions.product.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iauctions::products.title.products')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        $categories = $this->category->all();
        $ingredients = $this->ingredient->all();
        $unity = $this->unity;
        return view('iauctions::admin.products.edit', compact('product','categories','ingredients','unity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Product $product
     * @param  UpdateProductRequest $request
     * @return Response
     */
    public function update(Product $product, UpdateProductRequest $request)
    {
        $this->product->update($product, $request->all());

        return redirect()->route('admin.iauctions.product.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iauctions::products.title.products')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        $this->product->destroy($product);

        return redirect()->route('admin.iauctions.product.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iauctions::products.title.products')]));
    }

    /**
     * Search via AJAX
     *
     * @param  String $q
     * @return Response
     */
    public function searchAjax()
    {

        $data = array();
        $q = strtolower(Input::get('q'));
        $products = Product::select('id','name')
        ->where("name","like","%{$q}%")
        ->get();
        $data["data"] = $products;
        return response()->json($data);

    }

    
}
