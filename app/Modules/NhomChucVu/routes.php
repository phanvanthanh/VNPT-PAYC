<?php
$namespace = 'App\Modules\NhomChucVu\Controllers';

Route::group(
    ['module'=>'NhomChucVu', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('nhom-chuc-vu', [
            'as' => 'nhom-chuc-vu',
            'uses' => 'NhomChucVuController@nhomChucVu'
        ]);

        Route::post('danh-sach-nhom-chuc-vu', [
            'as' => 'danh-sach-nhom-chuc-vu',
            'uses' => 'NhomChucVuController@danhSachNhomChucVu'
        ]);

        Route::post('them-nhom-chuc-vu', [
            'as' => 'them-nhom-chuc-vu',
            'uses' => 'NhomChucVuController@themNhomChucVu'
        ]);

        Route::post('nhom-chuc-vu-single', [
            'as' => 'nhom-chuc-vu-single',
            'uses' => 'NhomChucVuController@nhomChucVuSingle'
        ]);

        Route::post('cap-nhat-nhom-chuc-vu', [
            'as' => 'cap-nhat-nhom-chuc-vu',
            'uses' => 'NhomChucVuController@capNhatNhomChucVu'
        ]);


        Route::post('xoa-nhom-chuc-vu', [
            'as' => 'xoa-nhom-chuc-vu',
            'uses' => 'NhomChucVuController@xoaNhomChucVu'
        ]);
    }
);