<?php
$namespace = 'App\Modules\DmTuan\Controllers';

Route::group(
    ['module'=>'DmTuan', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('dm-tuan', [
            'as' => 'dm-tuan',
            'uses' => 'DmTuanController@dmTuan'
        ]);

        Route::post('danh-sach-dm-tuan', [
            'as' => 'danh-sach-dm-tuan',
            'uses' => 'DmTuanController@danhSachDmTuan'
        ]);

        Route::post('them-dm-tuan', [
            'as' => 'them-dm-tuan',
            'uses' => 'DmTuanController@themDmTuan'
        ]);

        Route::post('them-dm-tuan-hang-loat', [
            'as' => 'them-dm-tuan-hang-loat',
            'uses' => 'DmTuanController@themDmTuanHangLoat'
        ]);

        Route::post('dm-tuan-single', [
            'as' => 'dm-tuan-single',
            'uses' => 'DmTuanController@dmTuanSingle'
        ]);

        Route::post('cap-nhat-dm-tuan', [
            'as' => 'cap-nhat-dm-tuan',
            'uses' => 'DmTuanController@capNhatDmTuan'
        ]);


        Route::post('xoa-dm-tuan', [
            'as' => 'xoa-dm-tuan',
            'uses' => 'DmTuanController@xoaDmTuan'
        ]);
    }
);