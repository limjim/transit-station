<?php
Route::group(['prefix' => 'proxy', 'namespace' => '\Megaads\TransitStation\Controllers'], function(){
    Route::any('transferring', [
        'as' => 'proxy::transferring', 'uses' => 'TransformerController@transferring'
    ]);
});
