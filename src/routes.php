<?php
Route::group(['prefix' => 'service', 'namespace' => '\Megaads\TransitStation\Controllers'], function(){
    Route::post('site/send-request', [
        'as' => 'tranformer::site::send::request', 'uses' => 'TransformerController@sendRequest'
    ]);
});
