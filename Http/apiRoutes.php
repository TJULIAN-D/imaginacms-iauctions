<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'iauctions'], function (Router $router) {

    $router->group(['prefix' => 'auctions'], function (Router $router) {
        
        $router->get('/', [
            'as' => 'iauctions.api.auctions',
            'uses' => 'AuctionController@auctions',
        ]);

        $router->get('/{param}', [
            'as' => 'iauctions.api.auction',
            'uses' => 'AuctionController@auction',
        ]);

    });

    $router->group(['prefix' => 'products'], function (Router $router) {
       
        $router->get('/', [
            'as' => 'iauctions.api.products',
            'uses' => 'ProductController@products',
        ]);

        $router->get('/{param}', [
            'as' => 'iauctions.api.product',
            'uses' => 'ProductController@product',
        ]);
       
    });

    $router->group(['prefix' => 'auctionproviders'], function (Router $router) {
        
        $router->post('/', [
            'as' => 'iauctions.api.auctionprovider.store',
            'uses' => 'AuctionProviderController@store',
            'middleware' => ['api.token', 'token-can:iauctions.auctionproviders.create']
        ]);

    });

    $router->group(['prefix' => 'bids'], function (Router $router) {
        // routes

    });


});