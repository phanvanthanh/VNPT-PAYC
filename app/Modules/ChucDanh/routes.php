<?php
$namespace = 'App\Modules\ChucDanh\Controllers';

Route::group(
    ['module'=>'ChucDanh', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('chuc-danh', [
            'as' => 'chuc-danh',
            'uses' => 'ChucDanhController@chucDanh'
        ]);

        Route::post('danh-sach-chuc-danh', [
            'as' => 'danh-sach-chuc-danh',
            'uses' => 'ChucDanhController@danhSachChucDanh'
        ]);

        Route::post('them-chuc-danh', [
            'as' => 'them-chuc-danh',
            'uses' => 'ChucDanhController@themChucDanh'
        ]);

        Route::post('chuc-danh-single', [
            'as' => 'chuc-danh-single',
            'uses' => 'ChucDanhController@chucDanhSingle'
        ]);

        Route::post('cap-nhat-chuc-danh', [
            'as' => 'cap-nhat-chuc-danh',
            'uses' => 'ChucDanhController@capNhatChucDanh'
        ]);


        Route::post('xoa-chuc-danh', [
            'as' => 'xoa-chuc-danh',
            'uses' => 'ChucDanhController@xoaChucDanh'
        ]);
    }
);