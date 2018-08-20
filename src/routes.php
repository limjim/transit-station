<?php
$this->app->group(['namespace' => 'Megaads\TransitStation\Controllers'], function($group){
    $group->post('service/site/send-request', 'TransformerController@sendRequest');
});
