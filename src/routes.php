<?php
Route::post('service/site/send-request', [
    'as' => 'service::site::send::request', 'uses' => 'Megaads\TransitStation\Controllers\TransformerController@sendRequest'
]);
