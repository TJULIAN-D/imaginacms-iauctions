<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/iauctions'], function (Router $router) {
    $router->bind('product', function ($id) {
        return app('Modules\Iauctions\Repositories\ProductRepository')->find($id);
    });
    $router->get('products', [
        'as' => 'admin.iauctions.product.index',
        'uses' => 'ProductController@index',
        'middleware' => 'can:iauctions.products.index'
    ]);
    $router->get('products/create', [
        'as' => 'admin.iauctions.product.create',
        'uses' => 'ProductController@create',
        'middleware' => 'can:iauctions.products.create'
    ]);
    $router->post('products', [
        'as' => 'admin.iauctions.product.store',
        'uses' => 'ProductController@store',
        'middleware' => 'can:iauctions.products.create'
    ]);
    $router->get('products/{product}/edit', [
        'as' => 'admin.iauctions.product.edit',
        'uses' => 'ProductController@edit',
        'middleware' => 'can:iauctions.products.edit'
    ]);
    $router->put('products/{product}', [
        'as' => 'admin.iauctions.product.update',
        'uses' => 'ProductController@update',
        'middleware' => 'can:iauctions.products.edit'
    ]);
    $router->delete('products/{product}', [
        'as' => 'admin.iauctions.product.destroy',
        'uses' => 'ProductController@destroy',
        'middleware' => 'can:iauctions.products.destroy'
    ]);

    // Ajax 
    $router->get('products/searchProducts', [
        'as'    => 'admin.iauctions.product.searchAjax',
        'uses'  => 'ProductController@searchAjax'
    ]);


    $router->bind('auction', function ($id) {
        return app('Modules\Iauctions\Repositories\AuctionRepository')->find($id);
    });
    $router->get('auctions', [
        'as' => 'admin.iauctions.auction.index',
        'uses' => 'AuctionController@index',
        'middleware' => 'can:iauctions.auctions.index'
    ]);
    $router->get('auctions/create', [
        'as' => 'admin.iauctions.auction.create',
        'uses' => 'AuctionController@create',
        'middleware' => 'can:iauctions.auctions.create'
    ]);
    $router->post('auctions', [
        'as' => 'admin.iauctions.auction.store',
        'uses' => 'AuctionController@store',
        'middleware' => 'can:iauctions.auctions.create'
    ]);
    $router->get('auctions/{auction}/edit', [
        'as' => 'admin.iauctions.auction.edit',
        'uses' => 'AuctionController@edit',
        'middleware' => 'can:iauctions.auctions.edit'
    ]);
    $router->put('auctions/{auction}', [
        'as' => 'admin.iauctions.auction.update',
        'uses' => 'AuctionController@update',
        'middleware' => 'can:iauctions.auctions.edit'
    ]);
    $router->delete('auctions/{auction}', [
        'as' => 'admin.iauctions.auction.destroy',
        'uses' => 'AuctionController@destroy',
        'middleware' => 'can:iauctions.auctions.destroy'
    ]);

    /*
    $router->bind('bid', function ($id) {
        return app('Modules\Iauctions\Repositories\BidRepository')->find($id);
    });

*/

    $router->get('bids/{id}/edit', [
        'as' => 'admin.iauctions.bid.edit',
        'uses' => 'BidController@edit',
        'middleware' => 'can:iauctions.bids.edit'
    ]);

    $router->bind('ingredient', function ($id) {
        return app('Modules\Iauctions\Repositories\IngredientRepository')->find($id);
    });
    $router->get('ingredients', [
        'as' => 'admin.iauctions.ingredient.index',
        'uses' => 'IngredientController@index',
        'middleware' => 'can:iauctions.ingredients.index'
    ]);
    $router->get('ingredients/create', [
        'as' => 'admin.iauctions.ingredient.create',
        'uses' => 'IngredientController@create',
        'middleware' => 'can:iauctions.ingredients.create'
    ]);
    $router->post('ingredients', [
        'as' => 'admin.iauctions.ingredient.store',
        'uses' => 'IngredientController@store',
        'middleware' => 'can:iauctions.ingredients.create'
    ]);
    $router->get('ingredients/{ingredient}/edit', [
        'as' => 'admin.iauctions.ingredient.edit',
        'uses' => 'IngredientController@edit',
        'middleware' => 'can:iauctions.ingredients.edit'
    ]);
    $router->put('ingredients/{ingredient}', [
        'as' => 'admin.iauctions.ingredient.update',
        'uses' => 'IngredientController@update',
        'middleware' => 'can:iauctions.ingredients.edit'
    ]);
    $router->delete('ingredients/{ingredient}', [
        'as' => 'admin.iauctions.ingredient.destroy',
        'uses' => 'IngredientController@destroy',
        'middleware' => 'can:iauctions.ingredients.destroy'
    ]);


    $router->bind('userproduct', function ($id) {
        return app('Modules\Iauctions\Repositories\UserProductRepository')->find($id);
    });
    $router->get('userproducts', [
        'as' => 'admin.iauctions.userproduct.index',
        'uses' => 'UserProductController@index',
        'middleware' => 'can:iauctions.userproducts.index'
    ]);
    $router->get('userproducts/create', [
        'as' => 'admin.iauctions.userproduct.create',
        'uses' => 'UserProductController@create',
        'middleware' => 'can:iauctions.userproducts.create'
    ]);
    $router->post('userproducts', [
        'as' => 'admin.iauctions.userproduct.store',
        'uses' => 'UserProductController@store',
        'middleware' => 'can:iauctions.userproducts.create'
    ]);
    $router->get('userproducts/{userproduct}/edit', [
        'as' => 'admin.iauctions.userproduct.edit',
        'uses' => 'UserProductController@edit',
        'middleware' => 'can:iauctions.userproducts.edit'
    ]);
    $router->put('userproducts/{userproduct}', [
        'as' => 'admin.iauctions.userproduct.update',
        'uses' => 'UserProductController@update',
        'middleware' => 'can:iauctions.userproducts.edit'
    ]);
    $router->delete('userproducts/{userproduct}', [
        'as' => 'admin.iauctions.userproduct.destroy',
        'uses' => 'UserProductController@destroy',
        'middleware' => 'can:iauctions.userproducts.destroy'
    ]);
    

    $router->bind('auctionproviderproduct', function ($id) {
        return app('Modules\Iauctions\Repositories\AuctionProviderProductRepository')->find($id);
    });
    $router->get('auctionproviderproducts', [
        'as' => 'admin.iauctions.auctionproviderproduct.index',
        'uses' => 'AuctionProviderProductController@index',
        'middleware' => 'can:iauctions.auctionproviderproducts.index'
    ]);
    $router->get('auctionproviderproducts/create', [
        'as' => 'admin.iauctions.auctionproviderproduct.create',
        'uses' => 'AuctionProviderProductController@create',
        'middleware' => 'can:iauctions.auctionproviderproducts.create'
    ]);
    $router->post('auctionproviderproducts', [
        'as' => 'admin.iauctions.auctionproviderproduct.store',
        'uses' => 'AuctionProviderProductController@store',
        'middleware' => 'can:iauctions.auctionproviderproducts.create'
    ]);
    $router->get('auctionproviderproducts/{auctionproviderproduct}/edit', [
        'as' => 'admin.iauctions.auctionproviderproduct.edit',
        'uses' => 'AuctionProviderProductController@edit',
        'middleware' => 'can:iauctions.auctionproviderproducts.edit'
    ]);
    $router->put('auctionproviderproducts/{auctionproviderproduct}', [
        'as' => 'admin.iauctions.auctionproviderproduct.update',
        'uses' => 'AuctionProviderProductController@update',
        'middleware' => 'can:iauctions.auctionproviderproducts.edit'
    ]);
    $router->delete('auctionproviderproducts/{auctionproviderproduct}', [
        'as' => 'admin.iauctions.auctionproviderproduct.destroy',
        'uses' => 'AuctionProviderProductController@destroy',
        'middleware' => 'can:iauctions.auctionproviderproducts.destroy'
    ]);


    /*
    $router->bind('auctionprovider', function ($id) {
        return app('Modules\Iauctions\Repositories\AuctionProviderRepository')->find($id);
    });
    */
    $router->get('auctionproviders', [
        'as' => 'admin.iauctions.auctionprovider.index',
        'uses' => 'AuctionProviderController@index',
        'middleware' => 'can:iauctions.auctionproviders.index'
    ]);
    $router->get('auctionproviders/create', [
        'as' => 'admin.iauctions.auctionprovider.create',
        'uses' => 'AuctionProviderController@create',
        'middleware' => 'can:iauctions.auctionproviders.create'
    ]);
    $router->post('auctionproviders', [
        'as' => 'admin.iauctions.auctionprovider.store',
        'uses' => 'AuctionProviderController@store',
        'middleware' => 'can:iauctions.auctionproviders.create'
    ]);
    $router->get('auctionproviders/{id}/edit', [
        'as' => 'admin.iauctions.auctionprovider.edit',
        'uses' => 'AuctionProviderController@edit',
        'middleware' => 'can:iauctions.auctionproviders.edit'
    ]);
    $router->put('auctionproviders/{auctionprovider}', [
        'as' => 'admin.iauctions.auctionprovider.update',
        'uses' => 'AuctionProviderController@update',
        'middleware' => 'can:iauctions.auctionproviders.edit'
    ]);
    $router->delete('auctionproviders/{auctionprovider}', [
        'as' => 'admin.iauctions.auctionprovider.destroy',
        'uses' => 'AuctionProviderController@destroy',
        'middleware' => 'can:iauctions.auctionproviders.destroy'
    ]);

    $router->post('auctionproviders/updateStatus/', [
        'as' => 'admin.iauctions.auctionprovider.updateStatus',
        'uses' => 'AuctionProviderController@updateStatus',
        'middleware' => 'can:iauctions.auctionproviders.edit'
    ]);

// append










});
