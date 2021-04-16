<?php

$namespace = 'App\Modules\Payc\Controllers';

Route::group(
    ['module'=>'Payc', 'namespace' => $namespace, 'middleware'=>['web']],
    function() {
        Route::get('payc', [
            'as' => 'payc',
            'uses' => 'PaycController@payc'
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

        Route::post('frm-duyet-va-chuyen-xu-ly-payc', [
            'as' => 'frm-duyet-va-chuyen-xu-ly-payc',
            'uses' => 'PaycController@frmDuyetVaChuyenXuLyPayc'
        ]);
        Route::post('duyet-va-chuyen-xu-ly-payc', [
            'as' => 'duyet-va-chuyen-xu-ly-payc',
            'uses' => 'PaycController@duyetVaChuyenXuLyPayc'
        ]);



        Route::post('frm-chuyen-lanh-dao', [
            'as' => 'frm-chuyen-lanh-dao',
            'uses' => 'PaycController@frmChuyenLanhDao'
        ]);
        Route::post('chuyen-lanh-dao', [
            'as' => 'chuyen-lanh-dao',
            'uses' => 'PaycController@chuyenLanhDao'
        ]);

        Route::post('frm-xu-ly-va-chuyen-lanh-dao', [
            'as' => 'frm-xu-ly-va-chuyen-lanh-dao',
            'uses' => 'PaycController@frmXuLyVaChuyenLanhDao'
        ]);
        Route::post('xu-ly-va-chuyen-lanh-dao', [
            'as' => 'xu-ly-va-chuyen-lanh-dao',
            'uses' => 'PaycController@xuLyVaChuyenLanhDao'
        ]);

        Route::post('frm-chuyen-cap-tren', [
            'as' => 'frm-chuyen-cap-tren',
            'uses' => 'PaycController@frmChuyenCapTren'
        ]);
        Route::post('chuyen-cap-tren', [
            'as' => 'chuyen-cap-tren',
            'uses' => 'PaycController@chuyenCapTren'
        ]);

        Route::post('frm-hoan-tat', [
            'as' => 'frm-hoan-tat',
            'uses' => 'PaycController@frmHoanTat'
        ]);
        Route::post('hoan-tat', [
            'as' => 'hoan-tat',
            'uses' => 'PaycController@hoanTat'
        ]);

        Route::post('frm-duyet-va-hoan-tat-xu-ly', [
            'as' => 'frm-duyet-va-hoan-tat-xu-ly',
            'uses' => 'PaycController@frmDuyetVaHoanTatXuLy'
        ]);
        Route::post('duyet-va-hoan-tat-xu-ly', [
            'as' => 'duyet-va-hoan-tat-xu-ly',
            'uses' => 'PaycController@duyetVahoanTatXuLy'
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

        Route::get('danh-sach-payc-theo-tai-khoan', [
            'as' => 'danh-sach-payc-theo-tai-khoan',
            'uses' => 'PaycController@danhSachPaycTheoTaiKhoan'
        ]);

        Route::get('danh-sach-payc-chua-co-can-bo-nhan', [
            'as' => 'danh-sach-payc-chua-co-can-bo-nhan',
            'uses' => 'PaycController@danhSachPaycChuaCoCanBoNhan'
        ]);

        Route::get('dang-ky-payc', [
            'as' => 'dang-ky-payc',
            'uses' => 'PaycController@dangKyPayc'
        ]);

        Route::post('luu-dang-ky-payc', [
            'as' => 'luu-dang-ky-payc',
            'uses' => 'PaycController@luuDangKyPayc'
        ]);

        Route::get('chi-tiet-payc', [
            'as' => 'chi-tiet-payc',
            'uses' => 'PaycController@chiTietPayc'
        ]);

        Route::post('chi-tiet-payc-noi-dung-single', [
            'as' => 'chi-tiet-payc-noi-dung-single',
            'uses' => 'PaycController@chiTietPaycNoiDungSingle'
        ]);
        Route::post('chi-tiet-payc-frm-binh-luan-single', [
            'as' => 'chi-tiet-payc-frm-binh-luan-single',
            'uses' => 'PaycController@chiTietPaycFrmBinhLuanSingle'
        ]);


        Route::post('gui-binh-luan', [
            'as' => 'gui-binh-luan',
            'uses' => 'PaycController@guiBinhLuan'
        ]);

        Route::post('danh-sach-binh-luan', [
            'as' => 'danh-sach-binh-luan',
            'uses' => 'PaycController@danhSachBinhLuan'
        ]);

        Route::post('hai-long', [
            'as' => 'hai-long',
            'uses' => 'PaycController@haiLong'
        ]);

        Route::post('khong-hai-long', [
            'as' => 'khong-hai-long',
            'uses' => 'PaycController@khongHaiLong'
        ]);

        Route::post('chi-tiet-payc-frm-can-bo-phan-hoi-binh-luan-single', [
            'as' => 'chi-tiet-payc-frm-can-bo-phan-hoi-binh-luan-single',
            'uses' => 'PaycController@chiTietPaycFrmCanBoPhanHoiBinhLuanSingle'
        ]);

        Route::post('tra-loi-binh-luan', [
            'as' => 'tra-loi-binh-luan',
            'uses' => 'PaycController@traLoiBinhLuan'
        ]);

        Route::post('danh-dau-da-xem-binh-luan', [
            'as' => 'danh-dau-da-xem-binh-luan',
            'uses' => 'PaycController@danhDauDaXemBinhLuan'
        ]);

        Route::post('danh-dau-da-xem-pakn', [
            'as' => 'danh-dau-da-xem-pakn',
            'uses' => 'PaycController@danhDauDaXemPakn'
        ]);
    }
);