<?php
$namespace = 'App\Modules\DmThongBao\Controllers';

Route::group(
    ['module'=>'DmThongBao', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('dm-thong-bao', [
            'as' => 'dm-thong-bao',
            'uses' => 'DmThongBaoController@dmThongBao'
        ]);

        Route::post('danh-sach-dm-thong-bao', [
            'as' => 'danh-sach-dm-thong-bao',
            'uses' => 'DmThongBaoController@danhSachDmThongBao'
        ]);

        Route::post('them-dm-thong-bao', [
            'as' => 'them-dm-thong-bao',
            'uses' => 'DmThongBaoController@themDmThongBao'
        ]);

        Route::post('dm-thong-bao-single', [
            'as' => 'dm-thong-bao-single',
            'uses' => 'DmThongBaoController@dmThongBaoSingle'
        ]);

        Route::post('cap-nhat-dm-thong-bao', [
            'as' => 'cap-nhat-dm-thong-bao',
            'uses' => 'DmThongBaoController@capNhatDmThongBao'
        ]);


        Route::post('xoa-dm-thong-bao', [
            'as' => 'xoa-dm-thong-bao',
            'uses' => 'DmThongBaoController@xoaDmThongBao'
        ]);

        Route::post('da-xem-thong-bao', [
            'as' => 'da-xem-thong-bao',
            'uses' => 'DmThongBaoController@daXemThongBao'
        ]);
    }
);