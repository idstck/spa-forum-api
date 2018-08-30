<?php

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::post('/auth/register', 'AuthController@register');
    Route::post('/auth/login', 'AuthController@login');

    Route::get('/channels', 'ChannelController@index');

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/user', 'UserController@index');
    });
});
