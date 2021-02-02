<?php
$namespace = 'App\Modules\DmXaPhuong\Controllers';
Route::group(
    ['module'=>'DmXaPhuong', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('/dm-xa-phuong', [
            'as' => 'dm-xa-phuong',
            'uses' => 'DmXaPhuongController@dmXaPhuong'
        ]);
        Route::post('/dm-xa-phuong/import', [
            'as' => 'dm-xa-phuong/import',
            'uses' => 'DmXaPhuongController@dmXaPhuongAndImport'
        ]);
    }
);