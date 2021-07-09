<?php

$namespace = 'App\Modules\TrangChu\Controllers';

Route::group(
    ['module'=>'TrangChu', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::match(['get', 'post'], '/', [
            'as' => 'home',
            'uses' => 'TrangChuController@home'
        ]);

    }
);