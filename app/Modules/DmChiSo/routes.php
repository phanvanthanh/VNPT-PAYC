<?php
$namespace = 'App\Modules\DmChiSo\Controllers';

Route::group(
    ['module'=>'DmChiSo', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('dm-chi-so-dhsxkd', [
            'as' => 'dm-chi-so',
            'uses' => 'DmChiSoController@dmChiSo'
        ]);

        Route::post('danh-sach-dm-chi-so', [
            'as' => 'danh-sach-dm-chi-so',
            'uses' => 'DmChiSoController@danhSachDmChiSo'
        ]);

        Route::post('them-dm-chi-so', [
            'as' => 'them-dm-chi-so',
            'uses' => 'DmChiSoController@themDmChiSo'
        ]);

        Route::post('dm-chi-so-single', [
            'as' => 'dm-chi-so-single',
            'uses' => 'DmChiSoController@dmChiSoSingle'
        ]);

        Route::post('cap-nhat-dm-chi-so', [
            'as' => 'cap-nhat-dm-chi-so',
            'uses' => 'DmChiSoController@capNhatDmChiSo'
        ]);


        Route::post('xoa-dm-chi-so', [
            'as' => 'xoa-dm-chi-so',
            'uses' => 'DmChiSoController@xoaDmChiSo'
        ]);
    }
);