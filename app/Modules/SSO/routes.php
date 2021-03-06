<?php
$namespace = 'App\Modules\SSO\Controllers';
use Illuminate\Support\Facades\Storage;

Route::group(
    ['module'=>'SSO', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::post('sso/login', [
            'as' => 'sso-dang-nhap',
            'uses' => 'SsoController@ssoDangNhap'
        ]);

        Route::post('sso/logout', [
            'as' => 'sso-dang-xuat',
            'uses' => 'SsoController@ssoDangXuat'
        ]);
    }
);
