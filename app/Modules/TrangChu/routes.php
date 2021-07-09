<?php

$namespace = 'App\Modules\TrangChu\Controllers';

Route::group(
    ['module'=>'TrangChu', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::match(['get', 'post'], '/', [
            'as' => 'home',
            'uses' => 'TrangChuController@home'
        ]);

        Route::get('/clear-cache', function() {
            $exitCode = Artisan::call('cache:clear');
            Artisan::call('view:clear');
            // return what you want
            
            return redirect()->route('to-do');
        });

    }
);