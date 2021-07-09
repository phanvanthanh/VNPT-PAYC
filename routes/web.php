<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Auth::routes([
  'verify' => false,
  'reset' => false
]);


$namespace = 'App\Modules\SSO\Controllers';
Route::group(
    ['module'=>'SSO', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::post('/', [
            'as' => 'sso-dang-nhap-2',
            'uses' => 'SsoController@ssoDangNhap2'
        ]);
    }
);
