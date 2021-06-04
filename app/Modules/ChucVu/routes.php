<?php
$namespace = 'App\Modules\ChucVu\Controllers';

Route::group(
    ['module'=>'ChucVu', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('chuc-vu', [
            'as' => 'chuc-vu',
            'uses' => 'ChucVuController@chucVu'
        ]);

        Route::post('danh-sach-chuc-vu', [
            'as' => 'danh-sach-chuc-vu',
            'uses' => 'ChucVuController@danhSachChucVu'
        ]);

        Route::post('them-chuc-vu', [
            'as' => 'them-chuc-vu',
            'uses' => 'ChucVuController@themChucVu'
        ]);

        Route::post('chuc-vu-single', [
            'as' => 'chuc-vu-single',
            'uses' => 'ChucVuController@chucVuSingle'
        ]);

        Route::post('cap-nhat-chuc-vu', [
            'as' => 'cap-nhat-chuc-vu',
            'uses' => 'ChucVuController@capNhatChucVu'
        ]);


        Route::post('xoa-chuc-vu', [
            'as' => 'xoa-chuc-vu',
            'uses' => 'ChucVuController@xoaChucVu'
        ]);
    }
);