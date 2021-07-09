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
    }
);


Route::group(
    ['module'=>'SSO', 'namespace' => $namespace, 'middleware'=>['api']],
    function() {
        Route::post('sso/login-2', [
            'as' => 'sso-dang-nhap-2',
            'uses' => 'SsoController@ssoDangNhap2'
        ]);
    }
);