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















        Route::get('danh-sach-payc-da-tiep-nhan', [
            'as' => 'danh-sach-payc-da-tiep-nhan',
            'uses' => 'PaycController@danhSachPaycDaTiepNhan'
        ]);

        Route::get('danh-sach-payc-da-hoan-tat', [
            'as' => 'danh-sach-payc-da-hoan-tat',
            'uses' => 'PaycController@danhSachPaycDaHoanTat'
        ]);

        Route::get('danh-sach-payc-da-chuyen-xu-ly', [
            'as' => 'danh-sach-payc-da-chuyen-xu-ly',
            'uses' => 'PaycController@danhSachPaycDaChuyenXuLy'
        ]);


        Route::get('danh-sach-payc-dang-xu-ly', [
            'as' => 'danh-sach-payc-dang-xu-ly',
            'uses' => 'PaycController@danhSachPaycDangXuLy'
        ]);

        Route::get('danh-sach-payc-da-chuyen-lanh-dao-duyet', [
            'as' => 'danh-sach-payc-da-chuyen-lanh-dao-duyet',
            'uses' => 'PaycController@danhSachPaycDaChuyenLanhDaoDuyet'
        ]);

        Route::get('danh-sach-payc-da-chuyen-lanh-dao-khac-duyet', [
            'as' => 'danh-sach-payc-da-chuyen-lanh-dao-khac-duyet',
            'uses' => 'PaycController@danhSachPaycDaChuyenLanhDaoKhacDuyet'
        ]);

        Route::get('danh-sach-payc-cho-duyet', [
            'as' => 'danh-sach-payc-cho-duyet',
            'uses' => 'PaycController@danhSachPaycChoDuyet'
        ]);

        Route::get('danh-sach-payc-da-duyet', [
            'as' => 'danh-sach-payc-da-duyet',
            'uses' => 'PaycController@danhSachPaycDaDuyet'
        ]);

        Route::get('danh-sach-payc-tra-lai-buoc-tiep-nhan', [
            'as' => 'danh-sach-payc-tra-lai-buoc-tiep-nhan',
            'uses' => 'PaycController@danhSachPaycTraLaiBuocTiepNhan'
        ]);


        Route::get('danh-sach-payc-tra-lai-can-bo-xu-ly', [
            'as' => 'danh-sach-payc-tra-lai-can-bo-xu-ly',
            'uses' => 'PaycController@danhSachPaycTraLaiCanBoXuLy'
        ]);


        Route::get('danh-sach-payc-da-huy', [
            'as' => 'danh-sach-payc-da-huy',
            'uses' => 'PaycController@danhSachPaycDaHuy'
        ]);


        Route::get('danh-sach-payc-cho-khach-hang-danh-gia', [
            'as' => 'danh-sach-payc-cho-khach-hang-danh-gia',
            'uses' => 'PaycController@danhSachPaycChoKhachHangDanhGia'
        ]);

        Route::get('danh-sach-payc-cho-lanh-dao-danh-gia', [
            'as' => 'danh-sach-payc-cho-lanh-dao-danh-gia',
            'uses' => 'PaycController@danhSachPaycChoLanhDaoDanhGia'
        ]);

        Route::get('danh-sach-payc-cho-can-bo-danh-gia', [
            'as' => 'danh-sach-payc-cho-can-bo-danh-gia',
            'uses' => 'PaycController@danhSachPaycChoCanBoDanhGia'
        ]);

        Route::get('danh-sach-payc-cho-cap-nhat', [
            'as' => 'danh-sach-payc-cho-cap-nhat',
            'uses' => 'PaycController@danhSachPaycChoCapNhat'
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