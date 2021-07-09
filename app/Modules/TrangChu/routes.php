<?php

$namespace = 'App\Modules\TrangChu\Controllers';

Route::group(
    ['module'=>'TrangChu', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::match(['get', 'post'], '/', [
            'as' => 'home',
            'uses' => 'TrangChuController@home'
        ]);

        Route::get('clear-all', function() {
            Artisan::call('view:clear');
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            return redirect()->route('to-do');
        });

        Route::get('clear-cache', function() {
            Artisan::call('cache:clear');
            return redirect()->route('to-do');
        });

        Route::get('clear-view', function() {
            Artisan::call('view:clear');
            return redirect()->route('to-do');
        });

        Route::get('clear-config', function() {
            Artisan::call('config:clear');
            return redirect()->route('to-do');
        });

        Route::get('clear-route', function() {
            Artisan::call('route:clear');
            return redirect()->route('to-do');
        });
    }
);