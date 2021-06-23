<?php
$namespace = 'App\Modules\BcLogDhsxkd\Controllers';

Route::group(
    ['module'=>'BcLogDhsxkd', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('log-dhsxkd', [
            'as' => 'bc-log-dhsxkd',
            'uses' => 'BcLogDhsxkdController@bcLogDhsxkd'
        ]);

        Route::post('danh-sach-bc-log-dhsxkd', [
            'as' => 'danh-sach-bc-log-dhsxkd',
            'uses' => 'BcLogDhsxkdController@danhSachBcLogDhsxkd'
        ]);
    }
);