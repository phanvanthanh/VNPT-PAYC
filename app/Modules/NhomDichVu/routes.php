<?php
$namespace = 'App\Modules\NhomDichVu\Controllers';

Route::group(
    ['module'=>'NhomDichVu', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('nhom-dich-vu', [
            'as' => 'nhom-dich-vu',
            'uses' => 'NhomDichVuController@nhomDichVu'
        ]);

        Route::post('danh-sach-nhom-dich-vu', [
            'as' => 'danh-sach-nhom-dich-vu',
            'uses' => 'NhomDichVuController@danhSachNhomDichVu'
        ]);

        Route::post('them-nhom-dich-vu', [
            'as' => 'them-nhom-dich-vu',
            'uses' => 'NhomDichVuController@themNhomDichVu'
        ]);

        Route::post('nhom-dich-vu-single', [
            'as' => 'nhom-dich-vu-single',
            'uses' => 'NhomDichVuController@nhomDichVuSingle'
        ]);

        Route::post('cap-nhat-nhom-dich-vu', [
            'as' => 'cap-nhat-nhom-dich-vu',
            'uses' => 'NhomDichVuController@capNhatNhomDichVu'
        ]);


        Route::post('xoa-nhom-dich-vu', [
            'as' => 'xoa-nhom-dich-vu',
            'uses' => 'NhomDichVuController@xoaNhomDichVu'
        ]);
    }
);