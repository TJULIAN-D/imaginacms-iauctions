<?php

namespace Modules\Iauctions\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Iauctions\Entities\Ingredient;
use Modules\Iauctions\Http\Requests\CreateIngredientRequest;
use Modules\Iauctions\Http\Requests\UpdateIngredientRequest;
use Modules\Iauctions\Repositories\IngredientRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class IngredientController extends AdminBaseController
{
    /**
     * @var IngredientRepository
     */
    private $ingredient;

    public function __construct(IngredientRepository $ingredient)
    {
        parent::__construct();

        $this->ingredient = $ingredient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $ingredients = $this->ingredient->all();
        return view('iauctions::admin.ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('iauctions::admin.ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateIngredientRequest $request
     * @return Response
     */
    public function store(CreateIngredientRequest $request)
    {
        $this->ingredient->create($request->all());

        return redirect()->route('admin.iauctions.ingredient.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('iauctions::ingredients.title.ingredients')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Ingredient $ingredient
     * @return Response
     */
    public function edit(Ingredient $ingredient)
    {
        return view('iauctions::admin.ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Ingredient $ingredient
     * @param  UpdateIngredientRequest $request
     * @return Response
     */
    public function update(Ingredient $ingredient, UpdateIngredientRequest $request)
    {
        $this->ingredient->update($ingredient, $request->all());

        return redirect()->route('admin.iauctions.ingredient.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('iauctions::ingredients.title.ingredients')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Ingredient $ingredient
     * @return Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $this->ingredient->destroy($ingredient);

        return redirect()->route('admin.iauctions.ingredient.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('iauctions::ingredients.title.ingredients')]));
    }
}
