<?php
$namespace = 'App\Modules\DmThamSoHeThong\Controllers';

Route::group(
    ['module'=>'DmThamSoHeThong', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('dm-tham-so-he-thong', [
            'as' => 'dm-tham-so-he-thong',
            'uses' => 'DmThamSoHeThongController@dmThamSoHeThong'
        ]);

        Route::post('danh-sach-dm-tham-so-he-thong', [
            'as' => 'danh-sach-dm-tham-so-he-thong',
            'uses' => 'DmThamSoHeThongController@danhSachDmThamSoHeThong'
        ]);

        Route::post('them-dm-tham-so-he-thong', [
            'as' => 'them-dm-tham-so-he-thong',
            'uses' => 'DmThamSoHeThongController@themDmThamSoHeThong'
        ]);

        Route::post('dm-tham-so-he-thong-single', [
            'as' => 'dm-tham-so-he-thong-single',
            'uses' => 'DmThamSoHeThongController@dmThamSoHeThongSingle'
        ]);

        Route::post('cap-nhat-dm-tham-so-he-thong', [
            'as' => 'cap-nhat-dm-tham-so-he-thong',
            'uses' => 'DmThamSoHeThongController@capNhatDmThamSoHeThong'
        ]);


        Route::post('xoa-dm-tham-so-he-thong', [
            'as' => 'xoa-dm-tham-so-he-thong',
            'uses' => 'DmThamSoHeThongController@xoaDmThamSoHeThong'
        ]);
    }
);