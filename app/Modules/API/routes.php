<?php
$namespace = 'App\Modules\API\Controllers';

Route::group(
    ['module'=>'API', 'namespace' => $namespace, 'prefix' => 'api/auth'],
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
Route::group(
    ['module'=>'API', 'namespace' => $namespace],
    function(){
        Route::post('api/api-gui-pakn', 'ApiPaycController@apiGuiPakn')->middleware('api'); // Nếu không có đăng nhập thì gửi bằng api này

        Route::get('api/api-lay-danh-muc-dich-vu', 'ApiDichVuController@layDanhMucDichVu');
        Route::get('api/api-lay-danh-muc-quan-huyen', 'ApiDmQuanHuyenController@layDanhMucQuanHuyen');
        Route::get('api/api-lay-danh-muc-phuong-xa', 'ApiDmPhuongXaController@layDanhMucPhuongXa');
        Route::get('api/api-lay-danh-muc-phuong-xa-theo-ma-quan-huyen', 'ApiDmPhuongXaController@layDanhMucPhuongXaTheoMaQuanHuyen');
        Route::post('api/api-payc-cua-toi', 'ApiPaycController@layPaycCuaToi');
        Route::post('api/get-file', 'ApiPaycController@getFile');
        Route::post('api/luu-file', 'ApiPaycController@luuFile');
    }
);