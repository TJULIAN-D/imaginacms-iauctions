<?php

use Illuminate\Routing\Router;

$router->get('iauctions/winner', [
    'as' => 'iauctions.api.auction.provider.index',
    'uses' => 'PublicController@index',

]);