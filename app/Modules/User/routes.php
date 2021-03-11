<?php
$namespace = 'App\Modules\User\Controllers';

Route::group(
    ['module'=>'User', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('user', [
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
    }
);