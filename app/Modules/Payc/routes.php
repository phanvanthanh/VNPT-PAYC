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
        Route::get('danh-sach-payc-cho-tiep-nhan', [
            'as' => 'danh-sach-payc-cho-tiep-nhan',
            'uses' => 'PaycController@danhSachPaycChoTiepNhan'
        ]);

        Route::get('danh-sach-payc-da-tiep-nhan', [
            'as' => 'danh-sach-payc-da-tiep-nhan',
            'uses' => 'PaycController@danhSachPaycDaTiepNhan'
        ]);

        Route::get('danh-sach-payc-da-hoan-tat', [
            'as' => 'danh-sach-payc-da-hoan-tat',
            'uses' => 'PaycController@danhSachPaycDaHoanTat'
        ]);

        Route::get('danh-sach-payc-da-chuyen-xu-ly', [
            'as' => 'danh-sach-payc-da-chuyen-xu-ly',
            'uses' => 'PaycController@danhSachPaycDaChuyenXuLy'
        ]);
        

        Route::post('them-payc', [
            'as' => 'them-payc',
            'uses' => 'PaycController@themPayc'
        ]);

    }
);