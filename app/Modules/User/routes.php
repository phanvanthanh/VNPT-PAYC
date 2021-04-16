<?php
$namespace = 'App\Modules\User\Controllers';

Route::group(
    ['module'=>'User', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('tai-khoan', [
            'as' => 'user',
            'uses' => 'UserController@user'
        ]);

        Route::post('danh-sach-user', [
            'as' => 'danh-sach-user',
            'uses' => 'UserController@danhSachUser'
        ]);

        Route::post('them-user', [
            'as' => 'them-user',
            'uses' => 'UserController@themUser'
        ]);

        Route::post('user-single', [
            'as' => 'user-single',
            'uses' => 'UserController@userSingle'
        ]);

        Route::post('cap-nhat-user', [
            'as' => 'cap-nhat-user',
            'uses' => 'UserController@capNhatUser'
        ]);


        Route::post('xoa-user', [
            'as' => 'xoa-user',
            'uses' => 'UserController@xoaUser'
        ]);

        Route::post('user-don-vi-single', [
            'as' => 'user-don-vi-single',
            'uses' => 'UserController@userDonViSingle'
        ]);

        Route::post('user-role-single', [
            'as' => 'user-role-single',
            'uses' => 'UserController@userRoleSingle'
        ]);
        Route::post('phan-quyen-user-role', [
            'as' => 'phan-quyen-user-role',
            'uses' => 'UserController@phanQuyenUserRole'
        ]);

        Route::post('luu-user-dv', [
            'as' => 'luu-user-dv',
            'uses' => 'UserController@luuUserDonVi'
        ]);

        Route::post('load-danh-sach-user-donvi', [
            'as' => 'load-danh-sach-user-donvi',
            'uses' => 'UserController@loadDsUserDonvi'
        ]);

        Route::post('xoa-user-donvi', [
            'as' => 'xoa-user-donvi',
            'uses' => 'UserController@xoaUserDonVi'
        ]);

        Route::get('thong-tin-ca-nhan', [
            'as' => 'thong-tin-ca-nhan',
            'uses' => 'UserController@thongTinCaNhan'
        ]);

        Route::post('cap-nhat-thong-tin-ca-nhan', [
            'as' => 'cap-nhat-thong-tin-ca-nhan',
            'uses' => 'UserController@capNhatThongTinCaNhan'
        ]);

        Route::post('user-dich-vu-single', [
            'as' => 'user-dich-vu-single',
            'uses' => 'UserController@userDichVuSingle'
        ]);

        Route::post('danh-sach-dich-vu-theo-tai-khoan', [
            'as' => 'danh-sach-dich-vu-theo-tai-khoan',
            'uses' => 'UserController@danhSachDichVuTheoTaiKhoan'
        ]);

        Route::post('them-user-dich-vu', [
            'as' => 'them-user-dich-vu',
            'uses' => 'UserController@themUserDichVu'
        ]);

        Route::post('xoa-user-dich-vu', [
            'as' => 'xoa-user-dich-vu',
            'uses' => 'UserController@xoaUserDichVu'
        ]);
    }
);