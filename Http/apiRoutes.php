<?php

use Illuminate\Routing\Router;

$router->group(['prefix' =>'/iauctions/v1'], function (Router $router) {
    $router->apiCrud([
      'module' => 'iauctions',
      'prefix' => 'auctions',
      'controller' => 'AuctionApiController',
      //'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []]
    ]);
    $router->apiCrud([
      'module' => 'iauctions',
      'prefix' => 'categories',
      'controller' => 'CategoryApiController',
      //'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []]
    ]);
    $router->apiCrud([
      'module' => 'iauctions',
      'prefix' => 'bids',
      'controller' => 'BidApiController',
      //'middleware' => ['create' => [], 'index' => [], 'show' => [], 'update' => [], 'delete' => [], 'restore' => []]
    ]);
   
    //Static Class
    $router->group(['prefix' => 'status-bid'], function (Router $router) {
      $router->get('/', [
        'as' => 'api.iauctions.status-bid.get.items.by',
        'uses' => 'StatusBidApiController@index',
        'middleware' => ['auth:api']
      ]);
    });
// append



});
