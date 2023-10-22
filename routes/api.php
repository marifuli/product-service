<?php

Route::group(['prefix' => 'api', 'namespace' => 'Marifuli\Service\Controllers\Api',], function(){
	Route::get('service/check', 'CheckController@index');
});