<?php
$namespace = 'App\Modules\DmPhuongXa\Controllers';
Route::group(
    ['module'=>'DmPhuongXa', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('/dm-phuong-xa', [
            'as' => 'dm-phuong-xa',
            'uses' => 'DmPhuongXaController@dmPhuongXa'
        ]);
        Route::post('/dm-phuong-xa/import', [
            'as' => 'dm-phuong-xa/import',
            'uses' => 'DmPhuongXaController@dmPhuongXaAndImport'
        ]);
    }
);