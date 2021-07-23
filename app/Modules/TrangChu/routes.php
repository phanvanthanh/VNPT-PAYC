<?php

$namespace = 'App\Modules\TrangChu\Controllers';

Route::group(
    ['module'=>'TrangChu', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::match(['get', 'post'], '/', [
            'as' => 'home',
            'uses' => 'TrangChuController@home'
        ]);

        Route::get('gioi-thieu', [
            'as' => 'gioi-thieu',
            'uses' => 'TrangChuController@gioiThieu'
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

Route::group(
    ['module'=>'TrangChu', 'namespace' => $namespace, 'middleware'=>['web', 'auth']],
    function() {
        Route::post('danh-sach-lich-ca-nhan-tuan', [
            'as' => 'danh-sach-lich-ca-nhan-tuan',
            'uses' => 'TrangChuController@danhSachLichCaNhanTuan'
        ]);

        Route::post('danh-sach-lich-ca-nhan-thang', [
            'as' => 'danh-sach-lich-ca-nhan-thang',
            'uses' => 'TrangChuController@danhSachLichCaNhanThang'
        ]);

        Route::get('task-board', [
            'as' => 'task-board',
            'uses' => 'TrangChuController@taskBoard'
        ]);

        Route::post('task-board-cap-nhat-trang-thai', [
            'as' => 'task-board-cap-nhat-trang-thai',
            'uses' => 'TrangChuController@taskBoardCapNhatTrangThai'
        ]);
    }
);