<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'iauctions'], function (Router $router) {


    $router->group(['prefix' => 'auctions'], function (Router $router) {


        $router->group(['prefix' => 'providers'], function (Router $router) {

            $router->get('/', [
                'as' => 'iauctions.api.auction.provider.index',
                'uses' => 'AuctionProviderController@index',
                //'middleware' => ['auth:api']
            ]);

            $router->get('{criteria}', [
                'as' => 'iauctions.api.auction.provider.show',
                'uses' => 'AuctionProviderController@show',
                //'middleware' => ['auth:api']
            ]);

            $router->put('{criteria}', [
                'as' => 'iauctions.api.auction.provider.update',
                'uses' => 'AuctionProviderController@update',
            ]);

        });
        $router->group(['prefix' => 'bid'], function (Router $router) {
            //Route create
            $router->post('/', [
                'as' => 'iauctions.api.bid.create',
                'uses' => 'BidController@create',
                'middleware' => ['auth:api']
            ]);

            //Route index
            $router->get('/', [
                'as' => 'iauctions.api.bid.get.items.by',
                'uses' => 'BidController@index',
                'middleware' => ['auth:api']
            ]);

            //Route show
            $router->get('/{criteria}', [
                'as' => 'iauctions.api.bid.get.item',
                'uses' => 'BidController@show',
                'middleware' => ['auth:api']
            ]);

            //Route update
            $router->put('/{criteria}', [
                'as' => 'iauctions.api.bid.update',
                'uses' => 'BidController@update',
                'middleware' => ['auth:api']
            ]);

            //Route delete
            $router->delete('/{criteria}', [
                'as' => 'iauctions.api.bid.delete',
                'uses' => 'BidController@delete',
                'middleware' => ['auth:api']
            ]);
        });

        //Route create
        $router->post('/', [
            'as' => 'iauctions.api.auction.create',
            'uses' => 'AuctionController@create',
            'middleware' => ['auth:api']
        ]);

        //Route index
        $router->get('/', [
            'as' => 'iauctions.api.auction.get.items.by',
            'uses' => 'AuctionController@index',
            //'middleware' => ['auth:api']
        ]);

        //Route show
        $router->get('/{criteria}', [
            'as' => 'iauctions.api.auction.get.item',
            'uses' => 'AuctionController@show',
            'middleware' => ['auth:api']
        ]);

        //Route update
        $router->put('/{criteria}', [
            'as' => 'iauctions.api.auction.update',
            'uses' => 'AuctionController@update',
            'middleware' => ['auth:api']
        ]);

        //Route delete
        $router->delete('/{criteria}', [
            'as' => 'iauctions.api.auction.delete',
            'uses' => 'AuctionController@delete',
            'middleware' => ['auth:api']
        ]);

        $router->get('/{param}', [
            'as' => 'iauctions.api.auction',
            'uses' => 'AuctionController@auction',
        ]);
        $router->post('{auction_id}/join', [
            'as' => 'iauctions.api.auction.provider.store',
            'uses' => 'AuctionProviderController@store',
            'middleware' => ['auth:api']
        ]);
        $router->put('{auction_id}/provider', [
            'as' => 'iauctions.api.auction.provider.update',
            'uses' => 'AuctionProviderController@update',
        ]);


    });

    $router->group(['prefix' => 'products'], function (Router $router) {
        //Route create
        $router->post('/', [
            'as' => 'iauctions.api.product.create',
            'uses' => 'ProductController@create',
            'middleware' => ['auth:api']
        ]);

        //Route index
        $router->get('/', [
            'as' => 'iauctions.api.product.get.items.by',
            'uses' => 'ProductController@index',
            //'middleware' => ['auth:api']
        ]);

        //Route show
        $router->get('/{criteria}', [
            'as' => 'iauctions.api.product.get.item',
            'uses' => 'ProductController@show',
            // 'middleware' => ['auth:api']
        ]);

        //Route update
        $router->put('/{criteria}', [
            'as' => 'iauctions.api.product.update',
            'uses' => 'ProductController@update',
            //'middleware' => ['auth:api']
        ]);

        //Route delete
        $router->delete('/{criteria}', [
            'as' => 'iauctions.api.product.delete',
            'uses' => 'ProductController@delete',
            //'middleware' => ['auth:api']
        ]);
    });
});

/*





    $router->group(['prefix' => 'providers'], function (Router $router) {
        $router->get('/{criteria}', [
            'as' => 'iauctions.api.auction.provider',
            'uses' => 'EntityApiController@show',
            'middleware' => ['auth:api']
        ]);
        $router->get('{apiauctionprovider}', [
            'as' => 'iauctions.api.auctionprovider',
            'uses' => 'AuctionProviderController@auctionprovider',
        ]);

        $router->get('auction/{auctionid}', [
            'as' => 'iauctions.api.auctionprovider.auctionuser',
            'uses' => 'AuctionProviderController@auctionuser',
            'middleware' => ['auth:api', /*'token-can:iauctions.auctionproviders.index']
        ]);

        $router->post('auction/{auctionid}', [
            'as' => 'iauctions.api.auctionprovider.store',
            'uses' => 'AuctionProviderController@store',
            'middleware' => ['auth:api']
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

    $router->group(['prefix' => 'auction'], function (Router $router) {
        $router->get('/forprovider', [
            'uses' => 'AuctionController@auctionsforprovider',
            'middleware' => ['auth:api']
        ]);
        $router->get('{id}/provider/products', [
            'uses' => 'AuctionController@productprovider',
            'middleware' => ['auth:api']
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
            'middleware' => ['auth:api']
        ]);

    });


});
  //Route create
    $router->post('/', [
      'as' => 'iauctions.api.entity.create',
      'uses' => 'EntityApiController@create',
      'middleware' => ['auth:api']
    ]);

    //Route index
    $router->get('/', [
      'as' => 'iauctions.api.entity.get.items.by',
      'uses' => 'EntityApiController@index',
      'middleware' => ['auth:api']
    ]);

    //Route show
    $router->get('/{criteria}', [
      'as' => 'iauctions.api.entity.get.item',
      'uses' => 'EntityApiController@show',
      'middleware' => ['auth:api']
    ]);

      //Route update
    $router->put('/{criteria}', [
      'as' => 'iauctions.api.entity.update',
      'uses' => 'EntityApiController@update',
      'middleware' => ['auth:api']
    ]);

    //Route delete
    $router->delete('/{criteria}', [
      'as' => 'iauctions.api.entity.delete',
      'uses' => 'EntityApiController@delete',
      'middleware' => ['auth:api']
    ]);

*/