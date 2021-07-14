<?php

$namespace = 'App\Modules\TaiLieu\Controllers';

Route::group(
    ['module'=>'TaiLieu', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('tai-lieu-huong-dan-can-bo', [
            'as' => 'tai-lieu-huong-dan-can-bo',
            'uses' => 'TaiLieuController@taiLieuHuongDanCanBo'
        ]);
    }
);