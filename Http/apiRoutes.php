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

    
        $router->bind('apiauctionprovider', function ($id) {
            return app(\Modules\Iauctions\Repositories\AuctionProviderRepository::class)->find($id);
        });

        $router->get('{apiauctionprovider}', [
            'as' => 'iauctions.api.auctionprovider',
            'uses' => 'AuctionProviderController@auctionprovider',
        ]);
       
        $router->get('auction/{auctionid}', [
            'as' => 'iauctions.api.auctionprovider.auctionuser',
            'uses' => 'AuctionProviderController@auctionuser',
            'middleware' => ['api.token', 'token-can:iauctions.auctionproviders.index']
        ]);
        
        $router->post('auction/{auctionid}', [
            'as' => 'iauctions.api.auctionprovider.store',
            'uses' => 'AuctionProviderController@store',
            'middleware' => ['api.token', 'token-can:iauctions.auctionproviders.create']
        ]);
       
    });

    $router->group(['prefix' => 'bids'], function (Router $router) {
       

        $router->get('/', [
            'as' => 'iauctions.api.bids',
            'uses' => 'BidController@bids',
        ]);

        $router->get('/{param}', [
            'as' => 'iauctions.api.bids',
            'uses' => 'BidController@bid',
        ]);

        $router->post('auction/{auctionid}', [
            'as' => 'iauctions.api.bids.store',
            'uses' => 'BidController@store',
            'middleware' => ['api.token', 'token-can:iauctions.bids.create']
        ]);

    });


});