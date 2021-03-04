<?php

$namespace = 'App\Modules\Payc\Controllers';

Route::group(
    ['module'=>'Payc', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('payc', [
            'as' => 'payc',
            'uses' => 'PaycController@payc'
        ]);

        Route::get('danh-sach-payc-an-danh', [
            'as' => 'danh-sach-payc-an-danh',
            'uses' => 'PaycController@danhSachPaycAnDanh'
        ]);

        Route::get('danh-sach-payc-cua-toi', [
            'as' => 'danh-sach-payc-cua-toi',
            'uses' => 'PaycController@danhSachPaycCuaToi'
        ]);
        Route::get('danh-sach-payc-cho-tiep-nhan', [
            'as' => 'danh-sach-payc-cho-tiep-nhan',
            'uses' => 'PaycController@danhSachPaycChoTiepNhan'
        ]);
        Route::post('frm-tiep-nhan-va-chuyen-xu-ly', [
            'as' => 'frm-tiep-nhan-va-chuyen-xu-ly',
            'uses' => 'PaycController@frmTiepNhanVaChuyenXuLy'
        ]);
        Route::post('tiep-nhan-va-chuyen-xu-ly', [
            'as' => 'tiep-nhan-va-chuyen-xu-ly',
            'uses' => 'PaycController@tiepNhanVaChuyenXuLy'
        ]);

        Route::get('danh-sach-payc-cho-xu-ly', [
            'as' => 'danh-sach-payc-cho-xu-ly',
            'uses' => 'PaycController@danhSachPaycChoXuLy'
        ]);

        Route::post('frm-xu-ly', [
            'as' => 'frm-xu-ly',
            'uses' => 'PaycController@frmXuLy'
        ]);
        Route::post('xu-ly', [
            'as' => 'xu-ly',
            'uses' => 'PaycController@xuLy'
        ]);

        Route::get('danh-sach-payc-cho-duyet', [
            'as' => 'danh-sach-payc-cho-duyet',
            'uses' => 'PaycController@danhSachPaycChoDuyet'
        ]);
        Route::post('frm-duyet', [
            'as' => 'frm-duyet',
            'uses' => 'PaycController@frmDuyet'
        ]);
        Route::post('duyet', [
            'as' => 'duyet',
            'uses' => 'PaycController@duyet'
        ]);


        Route::post('frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', [
            'as' => 'frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc',
            'uses' => 'PaycController@frmChuyenBoPhanTiepNhanVaXuLyPayc'
        ]);
        Route::post('chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', [
            'as' => 'chuyen-bo-phan-tiep-nhan-va-xu-ly-payc',
            'uses' => 'PaycController@chuyenBoPhanTiepNhanVaXuLyPayc'
        ]);

        Route::post('frm-chuyen-lanh-dao', [
            'as' => 'frm-chuyen-lanh-dao',
            'uses' => 'PaycController@frmChuyenLanhDao'
        ]);
        Route::post('chuyen-lanh-dao', [
            'as' => 'chuyen-lanh-dao',
            'uses' => 'PaycController@chuyenLanhDao'
        ]);

        Route::post('frm-hoan-tat', [
            'as' => 'frm-hoan-tat',
            'uses' => 'PaycController@frmHoanTat'
        ]);
        Route::post('hoan-tat', [
            'as' => 'hoan-tat',
            'uses' => 'PaycController@hoanTat'
        ]);

        Route::post('frm-tra-lai-khong-xu-ly', [
            'as' => 'frm-tra-lai-khong-xu-ly',
            'uses' => 'PaycController@frmTraLaiKhongXuLy'
        ]);
        Route::post('tra-lai-khong-xu-ly', [
            'as' => 'tra-lai-khong-xu-ly',
            'uses' => 'PaycController@traLaiKhongXuLy'
        ]);

        Route::post('frm-huy', [
            'as' => 'frm-huy',
            'uses' => 'PaycController@frmHuy'
        ]);
        Route::post('huy', [
            'as' => 'huy',
            'uses' => 'PaycController@huy'
        ]);


        Route::post('frm-cap-nhat-payc', [
            'as' => 'frm-cap-nhat-payc',
            'uses' => 'PaycController@frmCapNhatPayc'
        ]);
        Route::post('cap-nhat-payc', [
            'as' => 'cap-nhat-payc',
            'uses' => 'PaycController@capNhatPayc'
        ]);

        Route::get('danh-sach-payc-da-hoan-tat', [
            'as' => 'danh-sach-payc-da-hoan-tat',
            'uses' => 'PaycController@danhSachPaycDaHoanTat'
        ]);

        Route::post('chuyen-kh-danh-gia', [
            'as' => 'chuyen-kh-danh-gia',
            'uses' => 'PaycController@chuyenKHDanhGia'
        ]);

        Route::post('danh-gia', [
            'as' => 'danh-gia',
            'uses' => 'PaycController@danhGia'
        ]);


        


        Route::post('qtxl', [
            'as' => 'qtxl',
            'uses' => 'PaycController@qtxl'
        ]);

        
        

        Route::post('them-payc', [
            'as' => 'them-payc',
            'uses' => 'PaycController@themPayc'
        ]);

    }
);