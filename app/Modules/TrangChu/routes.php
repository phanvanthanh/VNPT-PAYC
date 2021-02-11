<?php

$namespace = 'App\Modules\TrangChu\Controllers';

Route::group(
    ['module'=>'TrangChu', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('/', [
            'as' => 'home',
            'uses' => 'TrangChuController@home'
        ]);

    }
);