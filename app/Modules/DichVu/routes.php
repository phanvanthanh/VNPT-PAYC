<?php
$namespace = 'App\Modules\DichVu\Controllers';

Route::group(
    ['module'=>'DichVu', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('dich-vu', [
            'as' => 'dich-vu',
            'uses' => 'DichVuController@dichVu'
        ]);

        Route::post('danh-sach-dich-vu', [
            'as' => 'danh-sach-dich-vu',
            'uses' => 'DichVuController@danhSachDichVu'
        ]);

        Route::post('them-dich-vu', [
            'as' => 'them-dich-vu',
            'uses' => 'DichVuController@themDichVu'
        ]);

        Route::post('dich-vu-single', [
            'as' => 'dich-vu-single',
            'uses' => 'DichVuController@dichVuSingle'
        ]);

        Route::post('cap-nhat-dich-vu', [
            'as' => 'cap-nhat-dich-vu',
            'uses' => 'DichVuController@capNhatDichVu'
        ]);


        Route::post('xoa-dich-vu', [
            'as' => 'xoa-dich-vu',
            'uses' => 'DichVuController@xoaDichVu'
        ]);
    }
);