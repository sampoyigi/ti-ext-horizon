<?php

Route::group([
    'prefix' => 'vendor/horizon',
    'namespace' => 'SamPoyigi\Horizon\Classes',
], function () {
    Route::get('js/app.js', 'AssetController@appJS');

    Route::get('css/app.css', 'AssetController@appCSS');

    Route::get('img/horizon.svg', 'AssetController@horizonSVG');
});
