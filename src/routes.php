<?php
Route::group(['prefix' => 'proxy', 'namespace' => '\Megaads\TransitStation\Controllers'], function(){
    Route::post('transferring/request', [
        'as' => 'proxy::transferring::request', 'uses' => 'TransformerController@transferringRequest'
    ]);
});
