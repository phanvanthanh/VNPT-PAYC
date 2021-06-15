<?php
$namespace = 'App\Modules\BaoCaoTuan\Controllers\VienThongHuyen';

Route::group(
    ['module'=>'BaoCaoTuan', 'namespace' => $namespace, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::group(['prefix'=>'bao-cao-tuan'],function(){
            Route::group(['prefix'=>'vien-thong-huyen'],function(){
                Route::get('/', [
                    'as' => 'bao-cao-tuan-vien-thong-huyen',
                    'uses' => 'VienThongHuyenController@baoCaoTuanVienThongHuyen'
                ]);

                Route::post('bao-cao-tuan-vien-thong-huyen-chot-so-lieu', [
                    'as' => 'bao-cao-tuan-vien-thong-huyen-chot-so-lieu',
                    'uses' => 'VienThongHuyenController@baoCaoTuanVienThongHuyenChotSoLieu'
                ]);

                
                

                // Báo cáo tuần hiện tại
                Route::post('danh-sach-bao-cao-tuan-hien-tai', [
                    'as' => 'danh-sach-bao-cao-tuan-hien-tai',
                    'uses' => 'VienThongHuyenController@danhSachBaoCaoTuanHienTai'
                ]);
                Route::post('them-bao-cao-tuan-hien-tai', [
                    'as' => 'them-bao-cao-tuan-hien-tai',
                    'uses' => 'VienThongHuyenController@themBaoCaoTuanHienTai'
                ]);

                Route::post('cap-nhat-bao-cao-tuan-hien-tai', [
                    'as' => 'cap-nhat-bao-cao-tuan-hien-tai',
                    'uses' => 'VienThongHuyenController@capNhatBaoCaoTuanHienTai'
                ]);

                Route::post('xoa-bao-cao-tuan-hien-tai', [
                    'as' => 'xoa-bao-cao-tuan-hien-tai',
                    'uses' => 'VienThongHuyenController@xoaBaoCaoTuanHienTai'
                ]);
                Route::post('bc-is-group-tuan-hien-tai', [
                    'as' => 'bc-is-group-tuan-hien-tai',
                    'uses' => 'VienThongHuyenController@bcIsGroupTuanHienTai'
                ]);

                Route::post('lay-du-lieu-tu-ke-hoach-tuan', [
                    'as' => 'lay-du-lieu-tu-ke-hoach-tuan',
                    'uses' => 'VienThongHuyenController@layDuLieuTuKeHoachTuan'
                ]);



                // Báo cáo Kế hoạch tuần kế tiếp
                Route::post('danh-sach-bao-cao-ke-hoach-tuan', [
                    'as' => 'danh-sach-bao-cao-ke-hoach-tuan',
                    'uses' => 'VienThongHuyenController@danhSachBaoCaoKeHoachTuan'
                ]);
                Route::post('them-bao-cao-ke-hoach-tuan', [
                    'as' => 'them-bao-cao-ke-hoach-tuan',
                    'uses' => 'VienThongHuyenController@themBaoCaoKeHoachTuan'
                ]);

                Route::post('cap-nhat-bao-cao-ke-hoach-tuan', [
                    'as' => 'cap-nhat-bao-cao-ke-hoach-tuan',
                    'uses' => 'VienThongHuyenController@capNhatBaoCaoKeHoachTuan'
                ]);

                Route::post('xoa-bao-cao-ke-hoach-tuan', [
                    'as' => 'xoa-bao-cao-ke-hoach-tuan',
                    'uses' => 'VienThongHuyenController@xoaBaoCaoKeHoachTuan'
                ]);
                Route::post('bc-is-group-ke-hoach-tuan', [
                    'as' => 'bc-is-group-ke-hoach-tuan',
                    'uses' => 'VienThongHuyenController@bcIsGroupKeHoachTuan'
                ]);

                // Báo cáo ĐHSXKD
                Route::post('danh-sach-bao-cao-dhsxkd', [
                    'as' => 'danh-sach-bao-cao-dhsxkd',
                    'uses' => 'VienThongHuyenController@danhSachBaoCaoDhsxkd'
                ]);

                Route::post('vien-thong-huyen-cap-nhat-ghi-chu-bao-cao-dhsxkd', [
                    'as' => 'vien-thong-huyen-cap-nhat-ghi-chu-bao-cao-dhsxkd',
                    'uses' => 'VienThongHuyenController@capNhatGhiChuBaoCaoDhsxkd'
                ]);

                Route::post('vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd', [
                    'as' => 'vien-thong-huyen-lay-so-lieu-bao-cao-dhsxkd',
                    'uses' => 'VienThongHuyenController@laySoLieuBaoCaoDhsxkd'
                ]);

                // Báo cáo tổng hợp
                Route::post('danh-sach-bao-cao-tong-hop', [
                    'as' => 'danh-sach-bao-cao-tong-hop',
                    'uses' => 'VienThongHuyenController@danhSachBaoCaoTongHop'
                ]);
            });                
        });
            
        
    }
);

$namespace2 = 'App\Modules\BaoCaoTuan\Controllers\DonViTrucThuocKhac';
Route::group(
    ['module'=>'BaoCaoTuan', 'namespace' => $namespace2, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::group(['prefix'=>'bao-cao-tuan'],function(){

            Route::group(['prefix'=>'don-vi-truc-thuoc-khac'],function(){
                Route::get('/', [
                    'as' => 'don-vi-truc-thuoc-khac-bao-cao-tuan',
                    'uses' => 'DonViTrucThuocKhacController@baoCaoTuan'
                ]);

                Route::post('don-vi-truc-thuoc-khac-bao-cao-tuan-chot-so-lieu', [
                    'as' => 'don-vi-truc-thuoc-khac-bao-cao-tuan-chot-so-lieu',
                    'uses' => 'DonViTrucThuocKhacController@baoCaoTuanChotSoLieu'
                ]);

                
                

                // Báo cáo tuần hiện tại
                Route::post('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tuan-hien-tai', [
                    'as' => 'don-vi-truc-thuoc-khac-danh-sach-bao-cao-tuan-hien-tai',
                    'uses' => 'DonViTrucThuocKhacController@danhSachBaoCaoTuanHienTai'
                ]);
                Route::post('don-vi-truc-thuoc-khac-them-bao-cao-tuan-hien-tai', [
                    'as' => 'don-vi-truc-thuoc-khac-them-bao-cao-tuan-hien-tai',
                    'uses' => 'DonViTrucThuocKhacController@themBaoCaoTuanHienTai'
                ]);

                Route::post('don-vi-truc-thuoc-khac-cap-nhat-bao-cao-tuan-hien-tai', [
                    'as' => 'don-vi-truc-thuoc-khac-cap-nhat-bao-cao-tuan-hien-tai',
                    'uses' => 'DonViTrucThuocKhacController@capNhatBaoCaoTuanHienTai'
                ]);

                Route::post('don-vi-truc-thuoc-khac-xoa-bao-cao-tuan-hien-tai', [
                    'as' => 'don-vi-truc-thuoc-khac-xoa-bao-cao-tuan-hien-tai',
                    'uses' => 'DonViTrucThuocKhacController@xoaBaoCaoTuanHienTai'
                ]);
                Route::post('don-vi-truc-thuoc-khac-bc-is-group-tuan-hien-tai', [
                    'as' => 'don-vi-truc-thuoc-khac-bc-is-group-tuan-hien-tai',
                    'uses' => 'DonViTrucThuocKhacController@bcIsGroupTuanHienTai'
                ]);

                Route::post('don-vi-truc-thuoc-khac-lay-du-lieu-tu-ke-hoach-tuan', [
                    'as' => 'don-vi-truc-thuoc-khac-lay-du-lieu-tu-ke-hoach-tuan',
                    'uses' => 'DonViTrucThuocKhacController@layDuLieuTuKeHoachTuan'
                ]);



                // Báo cáo Kế hoạch tuần kế tiếp
                Route::post('don-vi-truc-thuoc-khac-danh-sach-bao-cao-ke-hoach-tuan', [
                    'as' => 'don-vi-truc-thuoc-khac-danh-sach-bao-cao-ke-hoach-tuan',
                    'uses' => 'DonViTrucThuocKhacController@danhSachBaoCaoKeHoachTuan'
                ]);
                Route::post('don-vi-truc-thuoc-khac-them-bao-cao-ke-hoach-tuan', [
                    'as' => 'don-vi-truc-thuoc-khac-them-bao-cao-ke-hoach-tuan',
                    'uses' => 'DonViTrucThuocKhacController@themBaoCaoKeHoachTuan'
                ]);

                Route::post('don-vi-truc-thuoc-khac-cap-nhat-bao-cao-ke-hoach-tuan', [
                    'as' => 'don-vi-truc-thuoc-khac-cap-nhat-bao-cao-ke-hoach-tuan',
                    'uses' => 'DonViTrucThuocKhacController@capNhatBaoCaoKeHoachTuan'
                ]);

                Route::post('don-vi-truc-thuoc-khac-xoa-bao-cao-ke-hoach-tuan', [
                    'as' => 'don-vi-truc-thuoc-khac-xoa-bao-cao-ke-hoach-tuan',
                    'uses' => 'DonViTrucThuocKhacController@xoaBaoCaoKeHoachTuan'
                ]);
                Route::post('don-vi-truc-thuoc-khac-bc-is-group-ke-hoach-tuan', [
                    'as' => 'don-vi-truc-thuoc-khac-bc-is-group-ke-hoach-tuan',
                    'uses' => 'DonViTrucThuocKhacController@bcIsGroupKeHoachTuan'
                ]);

                // Báo cáo ĐHSXKD
                Route::post('don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd', [
                    'as' => 'don-vi-truc-thuoc-khac-danh-sach-bao-cao-dhsxkd',
                    'uses' => 'DonViTrucThuocKhacController@danhSachBaoCaoDhsxkd'
                ]);

                Route::post('don-vi-truc-thuoc-khac-cap-nhat-ghi-chu-bao-cao-dhsxkd', [
                    'as' => 'don-vi-truc-thuoc-khac-cap-nhat-ghi-chu-bao-cao-dhsxkd',
                    'uses' => 'DonViTrucThuocKhacController@capNhatGhiChuBaoCaoDhsxkd'
                ]);

                Route::post('don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd', [
                    'as' => 'don-vi-truc-thuoc-khac-lay-so-lieu-bao-cao-dhsxkd',
                    'uses' => 'DonViTrucThuocKhacController@laySoLieuBaoCaoDhsxkd'
                ]);

                // Báo cáo tổng hợp
                Route::post('don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop', [
                    'as' => 'don-vi-truc-thuoc-khac-danh-sach-bao-cao-tong-hop',
                    'uses' => 'DonViTrucThuocKhacController@danhSachBaoCaoTongHop'
                ]);
            });

                
        });
            
        
    }
);

$namespace3 = 'App\Modules\BaoCaoTuan\Controllers\TrungTamVienThong';
Route::group(
    ['module'=>'BaoCaoTuan', 'namespace' => $namespace3, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::group(['prefix'=>'bao-cao-tuan'],function(){

            Route::group(['prefix'=>'trung-tam-vien-thong'],function(){
                Route::get('/', [
                    'as' => 'trung-tam-vien-thong-bao-cao-tuan',
                    'uses' => 'TrungTamVienThongController@baoCaoTuan'
                ]);

                Route::post('trung-tam-vien-thong-bao-cao-tuan-chot-so-lieu', [
                    'as' => 'trung-tam-vien-thong-bao-cao-tuan-chot-so-lieu',
                    'uses' => 'TrungTamVienThongController@baoCaoTuanChotSoLieu'
                ]);

                
                

                // Báo cáo tuần hiện tại
                Route::post('trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai', [
                    'as' => 'trung-tam-vien-thong-danh-sach-bao-cao-tuan-hien-tai',
                    'uses' => 'TrungTamVienThongController@danhSachBaoCaoTuanHienTai'
                ]);
                Route::post('trung-tam-vien-thong-them-bao-cao-tuan-hien-tai', [
                    'as' => 'trung-tam-vien-thong-them-bao-cao-tuan-hien-tai',
                    'uses' => 'TrungTamVienThongController@themBaoCaoTuanHienTai'
                ]);

                Route::post('trung-tam-vien-thong-cap-nhat-bao-cao-tuan-hien-tai', [
                    'as' => 'trung-tam-vien-thong-cap-nhat-bao-cao-tuan-hien-tai',
                    'uses' => 'TrungTamVienThongController@capNhatBaoCaoTuanHienTai'
                ]);

                Route::post('trung-tam-vien-thong-xoa-bao-cao-tuan-hien-tai', [
                    'as' => 'trung-tam-vien-thong-xoa-bao-cao-tuan-hien-tai',
                    'uses' => 'TrungTamVienThongController@xoaBaoCaoTuanHienTai'
                ]);
                Route::post('trung-tam-vien-thong-bc-is-group-tuan-hien-tai', [
                    'as' => 'trung-tam-vien-thong-bc-is-group-tuan-hien-tai',
                    'uses' => 'TrungTamVienThongController@bcIsGroupTuanHienTai'
                ]);



                // Báo cáo Kế hoạch tuần kế tiếp
                Route::post('trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan', [
                    'as' => 'trung-tam-vien-thong-danh-sach-bao-cao-ke-hoach-tuan',
                    'uses' => 'TrungTamVienThongController@danhSachBaoCaoKeHoachTuan'
                ]);
                Route::post('trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan', [
                    'as' => 'trung-tam-vien-thong-them-bao-cao-ke-hoach-tuan',
                    'uses' => 'TrungTamVienThongController@themBaoCaoKeHoachTuan'
                ]);

                Route::post('trung-tam-vien-thong-cap-nhat-bao-cao-ke-hoach-tuan', [
                    'as' => 'trung-tam-vien-thong-cap-nhat-bao-cao-ke-hoach-tuan',
                    'uses' => 'TrungTamVienThongController@capNhatBaoCaoKeHoachTuan'
                ]);

                Route::post('trung-tam-vien-thong-xoa-bao-cao-ke-hoach-tuan', [
                    'as' => 'trung-tam-vien-thong-xoa-bao-cao-ke-hoach-tuan',
                    'uses' => 'TrungTamVienThongController@xoaBaoCaoKeHoachTuan'
                ]);
                Route::post('trung-tam-vien-thong-bc-is-group-ke-hoach-tuan', [
                    'as' => 'trung-tam-vien-thong-bc-is-group-ke-hoach-tuan',
                    'uses' => 'TrungTamVienThongController@bcIsGroupKeHoachTuan'
                ]);

                // Báo cáo ĐHSXKD
                Route::post('trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd', [
                    'as' => 'trung-tam-vien-thong-danh-sach-bao-cao-dhsxkd',
                    'uses' => 'TrungTamVienThongController@danhSachBaoCaoDhsxkd'
                ]);

                Route::post('trung-tam-vien-thong-cap-nhat-ghi-chu-bao-cao-dhsxkd', [
                    'as' => 'trung-tam-vien-thong-cap-nhat-ghi-chu-bao-cao-dhsxkd',
                    'uses' => 'TrungTamVienThongController@capNhatGhiChuBaoCaoDhsxkd'
                ]);

                Route::post('trung-tam-vien-thong-lay-so-lieu-bao-cao-dhsxkd', [
                    'as' => 'trung-tam-vien-thong-lay-so-lieu-bao-cao-dhsxkd',
                    'uses' => 'TrungTamVienThongController@laySoLieuBaoCaoDhsxkd'
                ]);

                // Báo cáo tổng hợp
                Route::post('trung-tam-vien-thong-danh-sach-bao-cao-tong-hop', [
                    'as' => 'trung-tam-vien-thong-danh-sach-bao-cao-tong-hop',
                    'uses' => 'TrungTamVienThongController@danhSachBaoCaoTongHop'
                ]);

                Route::post('trung-tam-vien-thong-lay-du-lieu-tu-ke-hoach-tuan', [
                    'as' => 'trung-tam-vien-thong-lay-du-lieu-tu-ke-hoach-tuan',
                    'uses' => 'TrungTamVienThongController@layDuLieuTuKeHoachTuan'
                ]);

                // Báo cáo tổng hợp
                Route::post('trung-tam-vien-thong-gui-thong-bao-nhac-nho-qua-telegram', [
                    'as' => 'trung-tam-vien-thong-gui-thong-bao-nhac-nho-qua-telegram',
                    'uses' => 'TrungTamVienThongController@guiThongBaoNhacNhoQuaTelegram'
                ]);

            });

                
        });
            
        
    }
);


$namespace4 = 'App\Modules\BaoCaoTuan\Controllers\VienThongTinh';
Route::group(
    ['module'=>'BaoCaoTuan', 'namespace' => $namespace4, 'middleware'=>['web', 'auth','check-role']],
    function() {
        Route::group(['prefix'=>'bao-cao-tuan'],function(){

            Route::group(['prefix'=>'vien-thong-tinh'],function(){
                Route::get('/', [
                    'as' => 'vien-thong-tinh-bao-cao-tuan',
                    'uses' => 'VienThongTinhController@baoCaoTuan'
                ]);

                // Báo cáo tổng hợp
                Route::post('vien-thong-tinh-danh-sach-bao-cao-tong-hop', [
                    'as' => 'vien-thong-tinh-danh-sach-bao-cao-tong-hop',
                    'uses' => 'VienThongTinhController@danhSachBaoCaoTongHop'
                ]);

                // Báo cáo tổng hợp
                Route::post('vien-thong-tinh-gui-thong-bao-nhac-nho-qua-telegram', [
                    'as' => 'vien-thong-tinh-gui-thong-bao-nhac-nho-qua-telegram',
                    'uses' => 'VienThongTinhController@guiThongBaoNhacNhoQuaTelegram'
                ]);

            });

                
        });
            
        
    }
);