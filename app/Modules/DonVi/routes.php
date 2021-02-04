<?php
$namespace = 'App\Modules\DonVi\Controllers';

Route::group(
    ['module'=>'DonVi', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('don-vi', [
            'as' => 'don-vi',
            'uses' => 'DonViController@donVi'
        ]);

        Route::post('danh-sach-don-vi', [
            'as' => 'danh-sach-don-vi',
            'uses' => 'DonViController@danhSachDonVi'
        ]);

        Route::post('them-don-vi', [
            'as' => 'them-don-vi',
            'uses' => 'DonViController@themDonVi'
        ]);

        Route::post('don-vi-single', [
            'as' => 'don-vi-single',
            'uses' => 'DonViController@donViSingle'
        ]);

        Route::post('cap-nhat-don-vi', [
            'as' => 'cap-nhat-don-vi',
            'uses' => 'DonViController@capNhatDonVi'
        ]);


        Route::post('xoa-don-vi', [
            'as' => 'xoa-don-vi',
            'uses' => 'DonViController@xoaDonVi'
        ]);
    }
);