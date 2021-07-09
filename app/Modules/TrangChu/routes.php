<?php

$namespace = 'App\Modules\TrangChu\Controllers';

Route::group(
    ['module'=>'TrangChu', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::match(['get', 'post'], '/', [
            'as' => 'home',
            'uses' => 'TrangChuController@home'
        ]);

        Route::get('/admin/clear-all', function() {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            return redirect()->route('to-do');
        });
    }
);