<?php
$namespace = 'App\Modules\TaiNguyen\Controllers';

Route::group(
    ['module'=>'TaiNguyen', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('tai-nguyen', [
            'as' => 'tai-nguyen',
            'uses' => 'TaiNguyenController@taiNguyen'
        ]);
        Route::post('danh-sach-tai-nguyen', [
            'as' => 'danh-sach-tai-nguyen',
            'uses' => 'TaiNguyenController@danhSachTaiNguyen'
        ]);

        Route::post('quet-tai-nguyen', [
            'as' => 'quet-tai-nguyen',
            'uses' => 'TaiNguyenController@quetTaiNguyen'
        ]);

        Route::post('them-tai-nguyen', [
            'as' => 'them-tai-nguyen',
            'uses' => 'TaiNguyenController@themTaiNguyen'
        ]);

        Route::post('tai-nguyen-single', [
            'as' => 'tai-nguyen-single',
            'uses' => 'TaiNguyenController@taiNguyenSingle'
        ]);

        Route::post('cap-nhat-tai-nguyen', [
            'as' => 'cap-nhat-tai-nguyen',
            'uses' => 'TaiNguyenController@capNhatTaiNguyen'
        ]);


        Route::post('xoa-tai-nguyen', [
            'as' => 'xoa-tai-nguyen',
            'uses' => 'TaiNguyenController@xoaTaiNguyen'
        ]);
        
    }
);