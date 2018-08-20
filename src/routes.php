<?php
Route::group(['prefix' => 'transformer', 'namespace' => '\Megaads\TransitStation\Controllers'], function(){
    Route::any('site/send-request', [
        'as' => 'tranformer::site::send::request', 'uses' => 'TransformerController@sendRequest'
    ]);
});
