<?php
$namespace = 'App\Modules\API\Controllers';

Route::group(
    ['module'=>'API', 'namespace' => $namespace, 'prefix' => 'auth'],
    function() {
        Route::post('api-dang-nhap', 'PassportAuthController@apiDangNhap');
    	Route::post('api-tao-tai-khoan', 'PassportAuthController@apiTaoTaiKhoan');

    	Route::group([
	      'middleware' => 'auth:api'
	    ], function() {
	        Route::get('api-dang-xuat', 'PassportAuthController@apiDangXuat');
	        Route::get('api-get-user', 'PassportAuthController@apiGetUser');
	    });

    }
);