<?php

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::post('/auth/register', 'AuthController@register');
});
