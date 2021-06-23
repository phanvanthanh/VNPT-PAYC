<?php
$namespace = 'App\Modules\MapDonViDhsxkd\Controllers';

Route::group(
    ['module'=>'MapDonViDhsxkd', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('map-don-vi-dhsxkd', [
            'as' => 'map-don-vi-dhsxkd',
            'uses' => 'MapDonViDhsxkdController@mapDonViDhsxkd'
        ]);

        Route::post('danh-sach-map-don-vi-dhsxkd', [
            'as' => 'danh-sach-map-don-vi-dhsxkd',
            'uses' => 'MapDonViDhsxkdController@danhSachMapDonViDhsxkd'
        ]);

        Route::post('quet-don-vi-lien-thong-dhsxkd', [
            'as' => 'quet-don-vi-lien-thong-dhsxkd',
            'uses' => 'MapDonViDhsxkdController@quetDonViLienThongDhsxkd'
        ]);

        Route::post('them-map-don-vi-dhsxkd', [
            'as' => 'them-map-don-vi-dhsxkd',
            'uses' => 'MapDonViDhsxkdController@themMapDonViDhsxkd'
        ]);

        Route::post('map-don-vi-dhsxkd-single', [
            'as' => 'map-don-vi-dhsxkd-single',
            'uses' => 'MapDonViDhsxkdController@mapDonViDhsxkdSingle'
        ]);

        Route::post('cap-nhat-map-don-vi-dhsxkd', [
            'as' => 'cap-nhat-map-don-vi-dhsxkd',
            'uses' => 'MapDonViDhsxkdController@capNhatMapDonViDhsxkd'
        ]);


        Route::post('xoa-map-don-vi-dhsxkd', [
            'as' => 'xoa-map-don-vi-dhsxkd',
            'uses' => 'MapDonViDhsxkdController@xoaMapDonViDhsxkd'
        ]);
    }
);