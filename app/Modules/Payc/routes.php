<?php

$namespace = 'App\Modules\Payc\Controllers';

Route::group(
    ['module'=>'Payc', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('payc', [
            'as' => 'payc',
            'uses' => 'PaycController@payc'
        ]);

        Route::get('danh-sach-payc-an-danh', [
            'as' => 'danh-sach-payc-an-danh',
            'uses' => 'PaycController@danhSachPaycAnDanh'
        ]);

        Route::get('danh-sach-payc-cua-toi', [
            'as' => 'danh-sach-payc-cua-toi',
            'uses' => 'PaycController@danhSachPaycCuaToi'
        ]);

        Route::post('them-payc', [
            'as' => 'them-payc',
            'uses' => 'PaycController@themPayc'
        ]);

    }
);