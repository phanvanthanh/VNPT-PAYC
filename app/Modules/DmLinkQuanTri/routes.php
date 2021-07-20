<?php
$namespace = 'App\Modules\DmLinkQuanTri\Controllers';

Route::group(
    ['module'=>'DmLinkQuanTri', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::get('dm-link-quan-tri', [
            'as' => 'dm-link-quan-tri',
            'uses' => 'DmLinkQuanTriController@dmLinkQuanTri'
        ]);

        Route::post('danh-sach-dm-link-quan-tri', [
            'as' => 'danh-sach-dm-link-quan-tri',
            'uses' => 'DmLinkQuanTriController@danhSachDmLinkQuanTri'
        ]);

        Route::post('them-dm-link-quan-tri', [
            'as' => 'them-dm-link-quan-tri',
            'uses' => 'DmLinkQuanTriController@themDmLinkQuanTri'
        ]);

        Route::post('dm-link-quan-tri-single', [
            'as' => 'dm-link-quan-tri-single',
            'uses' => 'DmLinkQuanTriController@dmLinkQuanTriSingle'
        ]);

        Route::post('cap-nhat-dm-link-quan-tri', [
            'as' => 'cap-nhat-dm-link-quan-tri',
            'uses' => 'DmLinkQuanTriController@capNhatDmLinkQuanTri'
        ]);


        Route::post('xoa-dm-link-quan-tri', [
            'as' => 'xoa-dm-link-quan-tri',
            'uses' => 'DmLinkQuanTriController@xoaDmLinkQuanTri'
        ]);

    }
);