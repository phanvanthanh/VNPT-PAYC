<?php
$namespace = 'App\Modules\TaiNguyen\Controllers';

Route::group(
    ['module'=>'TaiNguyen', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('tai-nguyen', [
            'as' => 'tai-nguyen',
            'uses' => 'TaiNguyenController@taiNguyen'
        ]);
        Route::post('tai-nguyen-all', [
            'as' => 'tai-nguyen-all',
            'uses' => 'TaiNguyenController@taiNguyenAll'
        ]);

        Route::post('quet-tai-nguyen', [
            'as' => 'quet-tai-nguyen',
            'uses' => 'TaiNguyenController@quetTaiNguyen'
        ]);

        Route::post('them-tai-nguyen', [
            'as' => 'them-tai-nguyen',
            'uses' => 'TaiNguyenController@themTaiNguyen'
        ]);

        Route::post('lay-tai-nguyen-theo-id', [
            'as' => 'lay-tai-nguyen-theo-id',
            'uses' => 'TaiNguyenController@layTaiNguyenTheoId'
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