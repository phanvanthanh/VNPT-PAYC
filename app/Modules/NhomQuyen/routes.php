<?php
$namespace = 'App\Modules\NhomQuyen\Controllers';

Route::group(
    ['module'=>'NhomQuyen', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('nhom-quyen', [
            'as' => 'nhom-quyen',
            'uses' => 'NhomQuyenController@nhomQuyen'
        ]);

        Route::post('danh-sach-nhom-quyen', [
            'as' => 'danh-sach-nhom-quyen',
            'uses' => 'NhomQuyenController@danhSachNhomQuyen'
        ]);

        Route::post('them-nhom-quyen', [
            'as' => 'them-nhom-quyen',
            'uses' => 'NhomQuyenController@themNhomQuyen'
        ]);

        Route::post('lay-nhom-quyen-theo-id', [
            'as' => 'lay-nhom-quyen-theo-id',
            'uses' => 'NhomQuyenController@layNhomQuyenTheoId'
        ]);

        Route::post('cap-nhat-nhom-quyen', [
            'as' => 'cap-nhat-nhom-quyen',
            'uses' => 'NhomQuyenController@capNhatNhomQuyen'
        ]);


        Route::post('xoa-nhom-quyen', [
            'as' => 'xoa-nhom-quyen',
            'uses' => 'NhomQuyenController@xoaNhomQuyen'
        ]);
    }
);