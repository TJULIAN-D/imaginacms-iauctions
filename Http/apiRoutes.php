<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => 'iauctions'], function (Router $router) {


    $router->group(['prefix' => 'auctions'], function (Router $router) {


        $router->group(['prefix' => 'providers'], function (Router $router) {

            $router->get('/', [
                'as' => 'iauctions.api.auction.provider.index',
                'uses' => 'AuctionProviderController@index',
                'middleware' => ['auth:api']
            ]);

            $router->get('{criteria}', [
                'as' => 'iauctions.api.auction.provider.show',
                'uses' => 'AuctionProviderController@show',
                'middleware' => ['auth:api']
            ]);

            $router->put('{criteria}', [
                'as' => 'iauctions.api.auction.provider.update',
                'uses' => 'AuctionProviderController@update',
                'middleware' => ['auth:api']
            ]);

        });

        $router->group(['prefix' => '{auction_id}'], function (Router $router) {

            $router->group(['prefix' => '/bids'], function (Router $router) {
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
                    'middleware' =>['auth:api']
                ]);
                //Route index
                $router->get('/order-bits', [
                    'as' => 'iauctions.api.bid.get.order',
                    'uses' => 'BidController@getOrder',
                     'middleware' => ['auth:api']
                ]);
                //Route show
                $router->get('/{criteria}', [
                    'as' => 'iauctions.api.bid.get.item',
                    'uses' => 'BidController@show',
                    'middleware' =>['auth:api']
                ]);

                //Route update
                $router->put('/{criteria}', [
                    'as' => 'iauctions.api.bid.update',
                    'uses' => 'BidController@update',
                    'middleware' =>['auth:api']
                ]);

                //Route delete
                $router->delete('/{criteria}', [
                    'as' => 'iauctions.api.bid.delete',
                    'uses' => 'BidController@delete',
                    'middleware' =>['auth:api']
                ]);
            });
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
                'middleware' => ['auth:api']
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
            'middleware' => ['auth:api']
        ]);

        //Route show
        $router->get('/{criteria}', [
            'as' => 'iauctions.api.product.get.item',
            'uses' => 'ProductController@show',
            'middleware' => ['auth:api']
        ]);
        //Route update
        $router->put('/{user_id}/join', [
            'as' => 'iauctions.api.product.join',
            'uses' => 'ProductController@join',
            'middleware' => ['auth:api']
        ]);
        //Route update
        $router->put('/{criteria}', [
            'as' => 'iauctions.api.product.update',
            'uses' => 'ProductController@update',
            'middleware' => ['auth:api']
        ]);

        //Route delete
        $router->delete('/{criteria}', [
            'as' => 'iauctions.api.product.delete',
            'uses' => 'ProductController@delete',
            'middleware' => ['auth:api']
        ]);
    });

    $router->group(['prefix' => 'ingredients'], function (Router $router) {
          //Route create
            $router->post('/', [
              'as' => 'iauctions.api.ingredient.create',
              'uses' => 'IngredientApiController@create',
              'middleware' => ['auth:api']
            ]);
          
            //Route index
            $router->get('/', [
              'as' => 'iauctions.api.ingredient.get.items.by',
              'uses' => 'IngredientApiController@index',
              'middleware' => ['auth:api']
            ]);
          
            //Route show
            $router->get('/{criteria}', [
              'as' => 'iauctions.api.ingredient.get.item',
              'uses' => 'IngredientApiController@show',
              'middleware' => ['auth:api']
            ]);
            
              //Route update
            $router->put('/{criteria}', [
              'as' => 'iauctions.api.ingredient.update',
              'uses' => 'IngredientApiController@update',
              'middleware' => ['auth:api']
            ]);
            
            //Route delete
            $router->delete('/{criteria}', [
              'as' => 'iauctions.api.ingredient.delete',
              'uses' => 'IngredientApiController@delete',
              'middleware' => ['auth:api']
            ]);
    });
});

