<?php
$namespace = 'App\Modules\PhanQuyen\Controllers';

Route::group(
    ['module'=>'PhanQuyen', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('phan-quyen', [
            'as' => 'phan-quyen',
            'uses' => 'PhanQuyenController@phanQuyen'
        ]);

        Route::post('phan-quyen-post', [
            'as' => 'phan-quyen-post',
            'uses' => 'PhanQuyenController@phanQuyenPost'
        ]);

        Route::post('phan-quyen/danh-sach-nhom-quyen', [
            'as' => 'phan-quyen/danh-sach-nhom-quyen',
            'uses' => 'PhanQuyenController@phanQuyenDanhSachNhomQuyen'
        ]);

        Route::post('phan-quyen/danh-sach-quyen-theo-nhom-quyen-id', [
            'as' => 'phan-quyen/danh-sach-quyen-theo-nhom-quyen-id',
            'uses' => 'PhanQuyenController@phanQuyenDanhSachQuyenTheoNhomQuyenId'
        ]);
    }
);