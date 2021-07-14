<?php

$namespace = 'App\Modules\TaiLieu\Controllers';

Route::group(
    ['module'=>'TaiLieu', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('tai-lieu', [
            'as' => 'tai-lieu',
            'uses' => 'TaiLieuController@taiLieu'
        ]);
    }
);