<?php
namespace App\Modules\BaoCaoTuan\Controllers\DonViTrucThuocKhac;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Request as RequestAjax;
use App\DonVi;
use App\DmThamSoHeThong;
use App\BcTuanHienTai;
use App\BcDmTuan;
use App\BcDmThoiGianBaoCao;
use App\BcKeHoachTuan;
use App\BcDhsxkd;
use App\BcPhanQuyenBaoCao;
use App\DichVu;
use App\UsersDichVu;


class DonViTrucThuocKhacController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function baoCaoTuan(Request $request){        
        $userId=0; $error=''; // Khai báo biến
        if(Auth::id()){
            $userId=Auth::id();
        }
        $year=date('Y');
        $bcDmTuan=BcDmTuan::where('nam','=',$year)
        ->get()->toArray();

        $dichVus=UsersDichVu::danhSachDichVuTheoTaiKhoan($userId);
        return view('BaoCaoTuan::don-vi-truc-thuoc-khac.bao-cao-tuan-don-vi-truc-thuoc-khac',compact('bcDmTuan', 'userId', 'dichVus'));
    }


    // Báo cáo tuần hiện tại
    public function danhSachBaoCaoTuanHienTai(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id_tuan'];
            $idDichVu=$data['id_dich_vu'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi tài khoản không có quyền báo cáo"); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];  
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma=''; // Mã đơn vị hay mã định danh
            $baoCaos=array();
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{ // Ngược lại báo cáo theo mã đơn vị
                $ma=$donVi['ma_don_vi'];
            }
            $this->ma=$ma;

            // Check báo cáo exits
            if($idDichVu){
                $checkBaoCaoExits=BcTuanHienTai::where('id_tuan','=',$idTuan)->where('id_dich_vu','=',$idDichVu)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                    })->orderBy('sap_xep','asc')->get()->toArray();                
                if(count($checkBaoCaoExits)<=0){
                    // Kiểm tra nếu có tiêu đề thì thêm tiêu đề vô
                    //$nhomDichVuBaoCao=BcPhanQuyenBaoCao::layDichVuBaoCaoCaoMacDinh($userId, 'BAO_CAO_TUAN_HIEN_TAI');
                    $nhomDichVuBaoCao=DichVu::where('id','=',$idDichVu)->get()->toArray();
                    if(count($nhomDichVuBaoCao)>0){
                        $dichVu=$nhomDichVuBaoCao[0]['ten_dich_vu'];
                        // Kiểm tra đang xem dữ liệu tuần hiện tại hay tuần trước
                        $weekFix=\Helper::layTuanHienTai();
                        $yearFix=date('Y');
                        $dmTuanFix=BcDmTuan::where('nam','=',$yearFix)->where('tuan','=',$weekFix)->get()->toArray();
                        $laTuanHienTai=0;
                        if(count($dmTuanFix)<=0){
                            $laTuanHienTai=0;
                        }else{
                            if ($dmTuanFix[0]['id']==$idTuan) {
                                $laTuanHienTai=1;
                            }
                        }
                        if(trim($dichVu," ")!='' && $laTuanHienTai==1){
                            $dataBaoCaoTuan=array();
                            $dataBaoCaoTuan['id_tuan']=$idTuan;
                            $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                            $dataBaoCaoTuan['noi_dung']=$dichVu;
                            $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataBaoCaoTuan['ghi_chu']=null;
                            $dataBaoCaoTuan['id_dich_vu']=$idDichVu;
                            $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                            $dataBaoCaoTuan['trang_thai']=0;
                            $dataBaoCaoTuan['is_group']=3;
                            $dataBaoCaoTuan['sap_xep']=0;
                            $baoCaoTuan=BcTuanHienTai::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                            $sapXep=$baoCaoTuan->id;
                            $baoCaoTuan->sap_xep=$sapXep;
                            $baoCaoTuan->save();
                        }                  
                    }
                        
                }
            }
                

            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $this->ma);
            $checkQuyenXemBaoCaoToanDonVi=BcPhanQuyenBaoCao::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'XEM_BAO_CAO_TOAN_DON_VI');
            if($checkQuyenXemBaoCaoToanDonVi===1 || $daChoSoLieu===2){
                $baoCaos=BcTuanHienTai::select('bc_tuan_hien_tai.id','bc_tuan_hien_tai.ma_don_vi','bc_tuan_hien_tai.ma_dinh_danh', 'bc_tuan_hien_tai.id_tuan', 'bc_tuan_hien_tai.id_user_bao_cao', 'bc_tuan_hien_tai.noi_dung', 'bc_tuan_hien_tai.thoi_gian_bao_cao', 'bc_tuan_hien_tai.ghi_chu', 'bc_tuan_hien_tai.is_group', 'bc_tuan_hien_tai.trang_thai', 'bc_tuan_hien_tai.sap_xep', 'bc_tuan_hien_tai.id_dich_vu')
                    ->leftJoin('dich_vu','bc_tuan_hien_tai.id_dich_vu','=','dich_vu.id')
                    ->where('bc_tuan_hien_tai.id_tuan','=',$idTuan)
                    ->where(function($query) {
                        $query->where('bc_tuan_hien_tai.ma_dinh_danh','=',$this->ma)->orWhere('bc_tuan_hien_tai.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_tuan_hien_tai.sap_xep','asc')
                    ->get()->toArray();
            }else{
                // Lấy lại số liệu báo cáo
                $dsDichVuTheoTaiKhoan=array();
                $dsDichVus=UsersDichVu::danhSachDichVuTheoTaiKhoan($userId);
                foreach ($dsDichVus as $key => $dichVu) {
                    $dsDichVuTheoTaiKhoan[$dichVu['id_dich_vu']]=$dichVu['id_dich_vu'];
                }
                $baoCaos=BcTuanHienTai::select('bc_tuan_hien_tai.id','bc_tuan_hien_tai.ma_don_vi','bc_tuan_hien_tai.ma_dinh_danh', 'bc_tuan_hien_tai.id_tuan', 'bc_tuan_hien_tai.id_user_bao_cao', 'bc_tuan_hien_tai.noi_dung', 'bc_tuan_hien_tai.thoi_gian_bao_cao', 'bc_tuan_hien_tai.ghi_chu', 'bc_tuan_hien_tai.is_group', 'bc_tuan_hien_tai.trang_thai', 'bc_tuan_hien_tai.sap_xep', 'bc_tuan_hien_tai.id_dich_vu')
                    ->leftJoin('dich_vu','bc_tuan_hien_tai.id_dich_vu','=','dich_vu.id')
                    ->where('bc_tuan_hien_tai.id_tuan','=',$idTuan)->whereIn('bc_tuan_hien_tai.id_dich_vu',$dsDichVuTheoTaiKhoan)
                    ->where(function($query) {
                        $query->where('bc_tuan_hien_tai.ma_dinh_danh','=',$this->ma)->orWhere('bc_tuan_hien_tai.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_tuan_hien_tai.sap_xep','asc')
                    ->get()->toArray();                
            }
            $view=view('BaoCaoTuan::don-vi-truc-thuoc-khac.danh-sach-bao-cao-tuan-hien-tai', compact('baoCaos','error','idTuan', 'ma'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    
    public function themBaoCaoTuanHienTai(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id_tuan'];
            $idDichVu=$data['id_dich_vu'];

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];  
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{
                $ma=$donVi['ma_don_vi'];
            }
            // Kiểm tra đã chốt số liệu chưa
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
            //if($daChoSoLieu==1){
            if($daChoSoLieu==2){
                return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
            }
            $checkExits=BcTuanHienTai::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('noi_dung','=',$data['noi_dung'])->get()->toArray();
            if(count($checkExits)<=0){
                if(strstr($data['noi_dung'], "\n")) {
                    $newStrings=explode("\n", $data['noi_dung']);
                    foreach($newStrings as $key => $string){
                        $string=trim($string," ");
                        if(strlen($string)>1){
                            $checkExit2=BcTuanHienTai::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('noi_dung','=',$string)->get()->toArray();
                            if(count($checkExit2)<=0){
                                $dataBaoCaoTuan=array();
                                $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                                $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                                $dataBaoCaoTuan['noi_dung']=$string;
                                $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                                $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                                $dataBaoCaoTuan['ghi_chu']=null;
                                $dataBaoCaoTuan['id_dich_vu']=$idDichVu;
                                $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                                $dataBaoCaoTuan['trang_thai']=0;
                                $dataBaoCaoTuan['is_group']=2;
                                $dataBaoCaoTuan['sap_xep']=0;
                                $baoCaoTuan=BcTuanHienTai::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                                $sapXep=$baoCaoTuan->id;
                                $baoCaoTuan->sap_xep=$sapXep;
                                $baoCaoTuan->save();
                            }
                        }
                    }
                }else{
                    $dataBaoCaoTuan=array();
                    $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                    $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                    $dataBaoCaoTuan['noi_dung']=$data['noi_dung'];
                    $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                    $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                    $dataBaoCaoTuan['ghi_chu']=null;
                    $dataBaoCaoTuan['id_dich_vu']=$idDichVu;
                    $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                    $dataBaoCaoTuan['trang_thai']=0;
                    $dataBaoCaoTuan['is_group']=2;
                    $dataBaoCaoTuan['sap_xep']=0;
                    $baoCaoTuan=BcTuanHienTai::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                    $sapXep=$baoCaoTuan->id;
                    $baoCaoTuan->sap_xep=$sapXep;
                    $baoCaoTuan->save();
                }
                    
            }                
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function capNhatBaoCaoTuanHienTai(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $baoCaos=BcTuanHienTai::where("id","=",$id)->get()->toArray();
            if(count($baoCaos)==1){
                unset($dataForm["_token"]);
                $baoCaos=BcTuanHienTai::where("id","=",$id);
                $baoCaos->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }


    public function xoaBaoCaoTuanHienTai(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $bcTuanHienTai=BcTuanHienTai::where("id","=",$id)->get();
            if(count($bcTuanHienTai)==1){
                // Kiểm tra đã chốt số liệu chưa
                $idTuan=$bcTuanHienTai[0]['id_tuan'];
                $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
                $ma='';
                if($baoCaoTheoMaDinhDanh==1){
                    $ma=$bcTuanHienTai[0]['ma_dinh_danh'];
                }else{
                    $ma=$bcTuanHienTai[0]['ma_don_vi'];
                }
                
                $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
                //if($daChoSoLieu==1){
                if($daChoSoLieu==2){
                    return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
                }
                // End Kiểm tra đã chốt số liệu chưa

                BcTuanHienTai::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
    public function bcIsGroupTuanHienTai(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            //$id=$dataForm['id']; //ngược lại có id
            $arrId=explode('_', $dataForm['id']);
            $id=$arrId[0];
            $numStyle=$arrId[1];
            $bcTuanHienTai=BcTuanHienTai::where("id","=",$id)->get();
            if(count($bcTuanHienTai)==1){
                // Kiểm tra đã chốt số liệu chưa
                $idTuan=$bcTuanHienTai[0]['id_tuan'];
                $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
                $ma='';
                if($baoCaoTheoMaDinhDanh==1){
                    $ma=$bcTuanHienTai[0]['ma_dinh_danh'];
                }else{
                    $ma=$bcTuanHienTai[0]['ma_don_vi'];
                }
                
                $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
                //if($daChoSoLieu==1){
                if($daChoSoLieu==2){
                    return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
                }
                // End Kiểm tra đã chốt số liệu chưa

                $bcTuanHienTai=BcTuanHienTai::find($id);
                if (!is_numeric($numStyle)) {
                    $numStyle=0;
                }
                $bcTuanHienTai->is_group=$numStyle;                
                $bcTuanHienTai->save();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
    
    // End báo cáo tuần hiện tại


    // Báo cáo tuần kế tiếp
    public function danhSachBaoCaoKeHoachTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id_tuan'];
            $idDichVu=$data['id_dich_vu'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];       
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma=''; // Mã đơn vị hay mã định danh
            $baoCaos=array();
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{ // Ngược lại báo cáo theo mã đơn vị                
                $ma=$donVi['ma_don_vi'];
            }
            $this->ma=$ma;
            // Check báo cáo tuần hiện tại
            if($idDichVu){
                $checkBaoCaoExits=BcKeHoachTuan::where('id_tuan','=',$idTuan)->where('id_dich_vu','=',$idDichVu)
                    ->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                    })->orderBy('sap_xep','asc')
                    ->get()->toArray();

                if(count($checkBaoCaoExits)<=0){
                    // Kiểm tra nếu có tiêu đề thì thêm tiêu đề vô
                    //$nhomDichVuBaoCao=BcPhanQuyenBaoCao::layDichVuBaoCaoCaoMacDinh($userId, 'BAO_CAO_KE_HOACH_TUAN');
                    $nhomDichVuBaoCao=DichVu::where('id','=',$idDichVu)->get()->toArray();
                    if(count($nhomDichVuBaoCao)>0){
                        $dichVu=$nhomDichVuBaoCao[0]['ten_dich_vu'];
                        // Kiểm tra đang xem dữ liệu tuần hiện tại hay tuần trước
                        $weekFix=\Helper::layTuanHienTai();
                        $yearFix=date('Y');
                        $dmTuanFix=BcDmTuan::where('nam','=',$yearFix)->where('tuan','=',$weekFix)->get()->toArray();
                        $laTuanHienTai=0;
                        if(count($dmTuanFix)<=0){
                            $laTuanHienTai=0;
                        }else{
                            if ($dmTuanFix[0]['id']==$idTuan) {
                                $laTuanHienTai=1;
                            }
                        }
                        if(trim($dichVu," ")!='' && $laTuanHienTai==1){
                            $dataBaoCaoTuan=array();
                            $dataBaoCaoTuan['id_tuan']=$idTuan;
                            $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                            $dataBaoCaoTuan['noi_dung']=$dichVu;
                            $dataBaoCaoTuan['id_dich_vu']=$idDichVu;
                            $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataBaoCaoTuan['ghi_chu']=null;
                            $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                            $dataBaoCaoTuan['trang_thai']=0;
                            $dataBaoCaoTuan['is_group']=3;
                            $dataBaoCaoTuan['sap_xep']=0;
                            $baoCaoTuan=BcKeHoachTuan::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                            $sapXep=$baoCaoTuan->id;
                            $baoCaoTuan->sap_xep=$sapXep;
                            $baoCaoTuan->save();
                        }
                        
                    }
                        
                }
            }

            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $this->ma);
            $checkQuyenXemBaoCaoToanDonVi=BcPhanQuyenBaoCao::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'XEM_BAO_CAO_TOAN_DON_VI');
            if($checkQuyenXemBaoCaoToanDonVi===1 || $daChoSoLieu==2){
                $baoCaos=BcKeHoachTuan::select('bc_ke_hoach_tuan.id','bc_ke_hoach_tuan.ma_don_vi','bc_ke_hoach_tuan.ma_dinh_danh', 'bc_ke_hoach_tuan.id_tuan', 'bc_ke_hoach_tuan.id_user_bao_cao', 'bc_ke_hoach_tuan.noi_dung', 'bc_ke_hoach_tuan.thoi_gian_bao_cao', 'bc_ke_hoach_tuan.ghi_chu', 'bc_ke_hoach_tuan.is_group', 'bc_ke_hoach_tuan.trang_thai', 'bc_ke_hoach_tuan.id_dich_vu', 'bc_ke_hoach_tuan.sap_xep')
                ->leftJoin('dich_vu','bc_ke_hoach_tuan.id_dich_vu','=','dich_vu.id')
                ->where('bc_ke_hoach_tuan.id_tuan','=',$idTuan)
                ->where(function($query) {
                    $query->where('bc_ke_hoach_tuan.ma_dinh_danh','=',$this->ma)->orWhere('bc_ke_hoach_tuan.ma_don_vi','=',$this->ma);
                })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_ke_hoach_tuan.sap_xep','asc')
                ->get()->toArray();
            }else{
                // Lấy lại số liệu báo cáo
                $dsDichVuTheoTaiKhoan=array();
                $dsDichVus=UsersDichVu::danhSachDichVuTheoTaiKhoan($userId);
                foreach ($dsDichVus as $key => $dichVu) {
                    $dsDichVuTheoTaiKhoan[$dichVu['id_dich_vu']]=$dichVu['id_dich_vu'];
                }

                $baoCaos=BcKeHoachTuan::select('bc_ke_hoach_tuan.id','bc_ke_hoach_tuan.ma_don_vi','bc_ke_hoach_tuan.ma_dinh_danh', 'bc_ke_hoach_tuan.id_tuan', 'bc_ke_hoach_tuan.id_user_bao_cao', 'bc_ke_hoach_tuan.noi_dung', 'bc_ke_hoach_tuan.thoi_gian_bao_cao', 'bc_ke_hoach_tuan.ghi_chu', 'bc_ke_hoach_tuan.is_group', 'bc_ke_hoach_tuan.trang_thai', 'bc_ke_hoach_tuan.id_dich_vu', 'bc_ke_hoach_tuan.sap_xep')
                    ->leftJoin('dich_vu','bc_ke_hoach_tuan.id_dich_vu','=','dich_vu.id')
                    ->where('bc_ke_hoach_tuan.id_tuan','=',$idTuan)->whereIn('bc_ke_hoach_tuan.id_dich_vu',$dsDichVuTheoTaiKhoan)
                    ->where(function($query) {
                        $query->where('bc_ke_hoach_tuan.ma_dinh_danh','=',$this->ma)->orWhere('bc_ke_hoach_tuan.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_ke_hoach_tuan.sap_xep','asc')
                    ->get()->toArray();
            }
                
            $view=view('BaoCaoTuan::don-vi-truc-thuoc-khac.danh-sach-bao-cao-ke-hoach-tuan', compact('baoCaos','error','idTuan', 'ma'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themBaoCaoKeHoachTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id_tuan'];
            $idDichVu=$data['id_dich_vu'];

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];  
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{
                $ma=$donVi['ma_don_vi'];
            }
            // Kiểm tra đã chốt số liệu chưa
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
            //if($daChoSoLieu==1){
            if($daChoSoLieu==2){
                return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
            }


            $checkExits=BcKeHoachTuan::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('noi_dung','=',$data['noi_dung'])->get()->toArray();
            if(count($checkExits)<=0){
                if(strstr($data['noi_dung'], "\n")) {
                    $newStrings=explode("\n", $data['noi_dung']);
                    foreach($newStrings as $key => $string){
                        $string=trim($string," ");
                        if(strlen($string)>1){
                            $checkExit2=BcKeHoachTuan::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('noi_dung','=',$string)->get()->toArray();
                            if(count($checkExit2)<=0){
                                $dataBaoCaoTuan=array();
                                $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                                $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                                $dataBaoCaoTuan['noi_dung']=$string;
                                $dataBaoCaoTuan['id_dich_vu']=$idDichVu;
                                $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                                $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                                $dataBaoCaoTuan['ghi_chu']=null;
                                $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                                $dataBaoCaoTuan['trang_thai']=0;
                                $dataBaoCaoTuan['is_group']=2;
                                $dataBaoCaoTuan['sap_xep']=0;
                                $baoCaoTuan=BcKeHoachTuan::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                                $sapXep=$baoCaoTuan->id;
                                $baoCaoTuan->sap_xep=$sapXep;
                                $baoCaoTuan->save();
                            }
                        }                            
                    }
                }
                else{
                    $dataBaoCaoTuan=array();
                    $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                    $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                    $dataBaoCaoTuan['noi_dung']=$data['noi_dung'];
                    $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                    $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                    $dataBaoCaoTuan['id_dich_vu']=$idDichVu;
                    $dataBaoCaoTuan['ghi_chu']=null;
                    $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                    $dataBaoCaoTuan['trang_thai']=0;
                    $dataBaoCaoTuan['is_group']=2;
                    $dataBaoCaoTuan['sap_xep']=0;
                    $baoCaoTuan=BcKeHoachTuan::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                    $sapXep=$baoCaoTuan->id;
                    $baoCaoTuan->sap_xep=$sapXep;
                    $baoCaoTuan->save();
                }
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function capNhatBaoCaoKeHoachTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $baoCaos=BcKeHoachTuan::where("id","=",$id)->get()->toArray();
            if(count($baoCaos)==1){
                unset($dataForm["_token"]);
                $baoCaos=BcKeHoachTuan::where("id","=",$id);
                $baoCaos->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    
    public function xoaBaoCaoKeHoachTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $bcKeHoachTuan=BcKeHoachTuan::where("id","=",$id)->get();
            if(count($bcKeHoachTuan)==1){
                // Kiểm tra đã chốt số liệu chưa
                $idTuan=$bcKeHoachTuan[0]['id_tuan'];
                $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
                $ma='';
                if($baoCaoTheoMaDinhDanh==1){
                    $ma=$bcKeHoachTuan[0]['ma_dinh_danh'];
                }else{
                    $ma=$bcKeHoachTuan[0]['ma_don_vi'];
                }
                
                $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
                //if($daChoSoLieu==1){
                if($daChoSoLieu==2){
                    return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
                }
                // End Kiểm tra đã chốt số liệu chưa

                BcKeHoachTuan::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function bcIsGroupKeHoachTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $arrId=explode('_', $dataForm['id']);
            $id=$arrId[0];
            $numStyle=$arrId[1];
            
            $bcKeHoachTuan=BcKeHoachTuan::where("id","=",$id)->get();
            if(count($bcKeHoachTuan)==1){
                // Kiểm tra đã chốt số liệu chưa
                $idTuan=$bcKeHoachTuan[0]['id_tuan'];
                $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
                $ma='';
                if($baoCaoTheoMaDinhDanh==1){
                    $ma=$bcKeHoachTuan[0]['ma_dinh_danh'];
                }else{
                    $ma=$bcKeHoachTuan[0]['ma_don_vi'];
                }
                
                $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
                //if($daChoSoLieu==1){
                if($daChoSoLieu==2){
                    return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
                }
                // End Kiểm tra đã chốt số liệu chưa

                $bcKeHoachTuan=BcKeHoachTuan::find($id);
                if (!is_numeric($numStyle)) {
                    $numStyle=0;
                }
                $bcKeHoachTuan->is_group=$numStyle; 
                $bcKeHoachTuan->save();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function layDuLieuTuKeHoachTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id_tuan'];

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi ".$donVi['message']); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];  
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{
                $ma=$donVi['ma_don_vi'];
            }
            // Kiểm tra đã chốt số liệu chưa
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
            //if($daChoSoLieu==1){
            if($daChoSoLieu==2){
                return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
            }

            // Lấy ngày lấy số liệu của tuần trước
            $this->ma=$ma;
            $tuan=0; $nam=0;
            $dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
            if(count($dmTuan)>0){
                $tuan=$dmTuan[0]['tuan'];
                $nam=$dmTuan[0]['nam'];
            }
            $idTuanTruoc=0;
            if($tuan==1) {
                $namTruoc=$nam-1;
                $thoiGianBaoCaoTheoDonViTuanTruoc=DB::SELECT('SELECT * FROM bc_dm_tuan dmt
                    WHERE dmt.tuan=(SELECT MAX(tuan) FROM bc_dm_tuan WHERE nam='.$namTruoc.')');
                $thoiGianBaoCaoTheoDonViTuanTruoc = collect($thoiGianBaoCaoTheoDonViTuanTruoc)->map(function($x){ return (array) $x; })->toArray(); 
                $idTuanTruoc=$thoiGianBaoCaoTheoDonViTuanTruoc[0]['id'];
            }else{
                $tuanTruoc=$tuan-1;
                $thoiGianBaoCaoTheoDonViTuanTruoc=DB::SELECT('SELECT * FROM bc_dm_tuan dmt
                    WHERE dmt.tuan='.$tuanTruoc.' AND dmt.nam='.$nam);
                $thoiGianBaoCaoTheoDonViTuanTruoc = collect($thoiGianBaoCaoTheoDonViTuanTruoc)->map(function($x){ return (array) $x; })->toArray(); 
                $idTuanTruoc=$thoiGianBaoCaoTheoDonViTuanTruoc[0]['id'];
            }
            $dmThoiGianBaoCaoTuanTruoc=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuanTruoc)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->get()->toArray();
            $ngayLayDuLieuTuanTruoc='';
            if(count($dmThoiGianBaoCaoTuanTruoc)>0){
                $ngayLayDuLieuTuanTruoc=$dmThoiGianBaoCaoTuanTruoc[0]['thoi_gian_lay_so_lieu'];
            }
            // End lấy ngày lấy số liệu của tuần trước

            // Lấy số liệu kế hoạch tuần trước làm báo cáo tuần hiện tại
            $keHoachTuanTruocs=BcKeHoachTuan::where('id_tuan','=',$idTuanTruoc)->where('id_user_bao_cao','=',$userId)->where(function($query) {
                $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
            })->get()->toArray();
            foreach ($keHoachTuanTruocs as $key => $keHoachTuanTruoc) {

                $checkBaoCaoExits=BcTuanHienTai::where('id_tuan','=',$idTuan)->where('id_dich_vu','=',$keHoachTuanTruoc['id_dich_vu'])->where('noi_dung','=',$keHoachTuanTruoc['noi_dung'])->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                    })->orderBy('sap_xep','asc')->get()->toArray();                
                if(count($checkBaoCaoExits)<=0){
                    $dataBaoCaoTuan=array();
                    $dataBaoCaoTuan['id_tuan']=$idTuan;
                    $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                    $dataBaoCaoTuan['noi_dung']=$keHoachTuanTruoc['noi_dung'];
                    $dataBaoCaoTuan['id_dich_vu']=$keHoachTuanTruoc['id_dich_vu'];
                    $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                    $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                    $dataBaoCaoTuan['ghi_chu']=null;
                    $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                    $dataBaoCaoTuan['trang_thai']=0;
                    $dataBaoCaoTuan['is_group']=$keHoachTuanTruoc['is_group'];
                    $dataBaoCaoTuan['sap_xep']=0;
                    $baoCaoTuan=BcTuanHienTai::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                    $sapXep=$baoCaoTuan->id;
                    $baoCaoTuan->sap_xep=$sapXep;
                    $baoCaoTuan->save();
                }
            }

                
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }
    // End báo cáo tuần kế tiếp

     // ĐHSXKD
    // Danh sách điều hành sản xuất kinh doanh
    /*
        Lấy trong bảng lên
    */
    protected $ma='';
    public function danhSachBaoCaoDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }

            $checkQuyenBaoCaoDhsxkd=BcPhanQuyenBaoCao::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_DHSXKD');
            if (!$checkQuyenBaoCaoDhsxkd) {
                return array('error'=>"Lỗi tài khoản không có quyền báo cáo.");
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];       
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma=''; // Mã đơn vị hay mã định danh
            $idThoiGianBaoCaoDhsxkd=0; $baoCaoPakns=array();
            $thoiGianLaySoLieu='';

            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{ // Ngược lại báo cáo theo mã đơn vị
                $ma=$donVi['ma_don_vi'];                
            }
            $this->ma=$ma;

            // Lấy ngày lấy số liệu của tuần trước
            $tuan=0; $nam=0;
            $dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
            if(count($dmTuan)>0){
                $tuan=$dmTuan[0]['tuan'];
                $nam=$dmTuan[0]['nam'];
            }

            $idThoiGianBaoCaoDhsxkd=0;
            $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
            })->get()->toArray();

            $daVuotThoiGianChotSoLieu=BcDmThoiGianBaoCao::kiemTraVuotNgayChotSoLieu($idTuan);
            $thoiGianLaySoLieu=date('Y-m-d H:i:s');
            if($daVuotThoiGianChotSoLieu){
                $dmGioChotBaoCao=DmThamSoHeThong::getValueByName('BC_THOI_GIAN_CHOT_BAO_CAO');
                $thoiGianLaySoLieu=$dmTuan[0]['den_ngay'].' '.$dmGioChotBaoCao; // Y-m-d H:i:s
            }


            if (count($thoiGianBaoCaoTheoDonVi)<=0) { // Nếu chưa có thì thêm vô và chốt luôn
                $dataDmThoiGianBaoCao=array();
                $dataDmThoiGianBaoCao['ma_don_vi']=$donVi['ma_don_vi'];
                $dataDmThoiGianBaoCao['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataDmThoiGianBaoCao['id_tuan']=$idTuan;
                $dataDmThoiGianBaoCao['thoi_gian_lay_so_lieu']=$thoiGianLaySoLieu;
                $dataDmThoiGianBaoCao['thoi_gian_chot_so_lieu']=null;
                $dataDmThoiGianBaoCao['ghi_chu']=null;
                $dataDmThoiGianBaoCao['trang_thai']=0;
                $bcDmThoiGianBaoCao=BcDmThoiGianBaoCao::create($dataDmThoiGianBaoCao);
                $idThoiGianBaoCaoDhsxkd=$bcDmThoiGianBaoCao->id;

            }else{ //Ngược lại thì chốt
                $idThoiGianBaoCaoDhsxkd=$thoiGianBaoCaoTheoDonVi[0]['id'];
            }
            $baoCaoPakns=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PAKN');

            
            $idTuanTruoc=0;
            $idTuanTruoc=0;
            if($tuan==1) {
                $namTruoc=$nam-1;
                $thoiGianBaoCaoTheoDonViTuanTruoc=DB::SELECT('SELECT * FROM bc_dm_tuan dmt
                    WHERE dmt.tuan=(SELECT MAX(tuan) FROM bc_dm_tuan WHERE nam='.$namTruoc.')');
                $thoiGianBaoCaoTheoDonViTuanTruoc = collect($thoiGianBaoCaoTheoDonViTuanTruoc)->map(function($x){ return (array) $x; })->toArray(); 
                $idTuanTruoc=$thoiGianBaoCaoTheoDonViTuanTruoc[0]['id'];
            }else{
                $tuanTruoc=$tuan-1;
                $thoiGianBaoCaoTheoDonViTuanTruoc=DB::SELECT('SELECT * FROM bc_dm_tuan dmt
                    WHERE dmt.tuan='.$tuanTruoc.' AND dmt.nam='.$nam);
                $thoiGianBaoCaoTheoDonViTuanTruoc = collect($thoiGianBaoCaoTheoDonViTuanTruoc)->map(function($x){ return (array) $x; })->toArray(); 
                $idTuanTruoc=$thoiGianBaoCaoTheoDonViTuanTruoc[0]['id'];
            }
            $dmThoiGianBaoCaoTuanTruoc=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuanTruoc)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->get()->toArray();
            $ngayLayDuLieuTuanTruoc='';
            if(count($dmThoiGianBaoCaoTuanTruoc)>0){
                $ngayLayDuLieuTuanTruoc=$dmThoiGianBaoCaoTuanTruoc[0]['thoi_gian_lay_so_lieu'];
            }
            // End lấy ngày lấy số liệu của tuần trước
            $view=view('BaoCaoTuan::don-vi-truc-thuoc-khac.danh-sach-bao-cao-dhsxkd', compact('baoCaoPakns','error','idTuan', 'ma', 'thoiGianLaySoLieu', 'ngayLayDuLieuTuanTruoc'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function capNhatGhiChuBaoCaoDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $id=$data['id'];
            $ghiChu=$data['ghi_chu'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi tài khoản không có quyền báo cáo"); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];   

            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{
                $ma=$donVi['ma_don_vi'];
            }

            $this->ma=$ma;
            $bcDhsxkd=BcDhsxkd::where('id',$id)->where(function($query) {
                $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
            })->update(['ghi_chu'=>$ghiChu]);
            return array('error'=>""); // Trả về lỗi phương thức truyền số liệu
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function laySoLieuBaoCaoDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $checkQuyenDuyetVaGuiBaoCao=BcPhanQuyenBaoCao::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_DHSXKD');
            if(!$checkQuyenDuyetVaGuiBaoCao){
                return array('error'=>"Lỗi bạn không có quyền cập nhật số liệu báo cáo ĐHSXKD.");
            }


            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi tài khoản không có quyền báo cáo"); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];   

            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{
                $ma=$donVi['ma_don_vi'];
            }
            $this->ma=$ma;

            $tuan=0; $nam=0;
            $dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
            if(count($dmTuan)>0){
                $tuan=$dmTuan[0]['tuan'];
                $nam=$dmTuan[0]['nam'];
            }


            $daVuotThoiGianChotSoLieu=BcDmThoiGianBaoCao::kiemTraVuotNgayChotSoLieu($idTuan);
            $thoiGianLaySoLieu=date('Y-m-d H:i:s');
            if($daVuotThoiGianChotSoLieu){
                $dmGioChotBaoCao=DmThamSoHeThong::getValueByName('BC_THOI_GIAN_CHOT_BAO_CAO');
                $thoiGianLaySoLieu=$dmTuan[0]['den_ngay'].' '.$dmGioChotBaoCao; // Y-m-d H:i:s
            }

            
            // Nếu chưa chốt số liệu thì cho lấy số liệu
            // Ngược lại không lấy
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
            if($daChoSoLieu==0){
                $idThoiGianBaoCaoDhsxkd=0;
                

                // Cập nhật lại thời gian lấy số liệu                
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->get()->toArray();
                if(count($thoiGianBaoCaoTheoDonVi)<=0){
                    $dataDmThoiGianBaoCao=array();
                    $dataDmThoiGianBaoCao['ma_don_vi']=$donVi['ma_don_vi'];
                    $dataDmThoiGianBaoCao['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                    $dataDmThoiGianBaoCao['id_tuan']=$idTuan;
                    $dataDmThoiGianBaoCao['thoi_gian_lay_so_lieu']=$thoiGianLaySoLieu;
                    $dataDmThoiGianBaoCao['thoi_gian_chot_so_lieu']=null;
                    $dataDmThoiGianBaoCao['ghi_chu']=null;
                    $dataDmThoiGianBaoCao['trang_thai']=0;
                    $bcDmThoiGianBaoCao=BcDmThoiGianBaoCao::create($dataDmThoiGianBaoCao);
                    $idThoiGianBaoCaoDhsxkd=$bcDmThoiGianBaoCao->id;

                }else{
                    $idThoiGianBaoCaoDhsxkd=$thoiGianBaoCaoTheoDonVi[0]['id'];
                    BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                    })->update(['thoi_gian_lay_so_lieu'=>$thoiGianLaySoLieu]);
                }

                // Lấy ngày lấy số liệu của tuần trước
                
                $idTuanTruoc=0;
                $idTuanTruoc=0;
                if($tuan==1) {
                    $namTruoc=$nam-1;
                    $thoiGianBaoCaoTheoDonViTuanTruoc=DB::SELECT('SELECT * FROM bc_dm_tuan dmt
                        WHERE dmt.tuan=(SELECT MAX(tuan) FROM bc_dm_tuan WHERE nam='.$namTruoc.')');
                    $thoiGianBaoCaoTheoDonViTuanTruoc = collect($thoiGianBaoCaoTheoDonViTuanTruoc)->map(function($x){ return (array) $x; })->toArray(); 
                    $idTuanTruoc=$thoiGianBaoCaoTheoDonViTuanTruoc[0]['id'];
                }else{
                    $tuanTruoc=$tuan-1;
                    $thoiGianBaoCaoTheoDonViTuanTruoc=DB::SELECT('SELECT * FROM bc_dm_tuan dmt
                        WHERE dmt.tuan='.$tuanTruoc.' AND dmt.nam='.$nam);
                    $thoiGianBaoCaoTheoDonViTuanTruoc = collect($thoiGianBaoCaoTheoDonViTuanTruoc)->map(function($x){ return (array) $x; })->toArray(); 
                    $idTuanTruoc=$thoiGianBaoCaoTheoDonViTuanTruoc[0]['id'];
                }
                $dmThoiGianBaoCaoTuanTruoc=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuanTruoc)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                    })->get()->toArray();
                $ngayLayDuLieuTuanTruoc='';
                if(count($dmThoiGianBaoCaoTuanTruoc)>0){
                    $ngayLayDuLieuTuanTruoc=$dmThoiGianBaoCaoTuanTruoc[0]['thoi_gian_lay_so_lieu'];
                }
                // End lấy ngày lấy số liệu của tuần trước

                // Lấy lại số liệu
                BcDhsxkd::where('id_thoigian_baocao','=',$idThoiGianBaoCaoDhsxkd)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                    })->delete();
                
            }else{ 

            }

            return array('error'=>""); // Trả về lỗi phương thức truyền số liệu
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }
    // End báo cáo dhsxkd

    // Chốt và gửi báo cáo tổng hợp
    public function danhSachBaoCaoTongHop(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];
            $dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
            if(count($dmTuan)<=0){
                return array('error'=>"Lỗi không tìm thấy thời gian báo cáo");
            }
            $dmTuan=$dmTuan[0];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];       
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma=''; // Mã đơn vị hay mã định danh
            $baoCaoTuanHienTais=array();

            $idThoiGianBaoCaoDhsxkd=0; $baoCaoPakns=array();
            $thoiGianLaySoLieu='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{ // Ngược lại báo cáo theo mã đơn vị
                $ma=$donVi['ma_don_vi'];
            }
            $this->ma=$ma;


            $daVuotThoiGianChotSoLieu=BcDmThoiGianBaoCao::kiemTraVuotNgayChotSoLieu($idTuan);
            $thoiGianLaySoLieu=date('Y-m-d H:i:s');
            if($daVuotThoiGianChotSoLieu){
                $dmGioChotBaoCao=DmThamSoHeThong::getValueByName('BC_THOI_GIAN_CHOT_BAO_CAO');
                $thoiGianLaySoLieu=$dmTuan['den_ngay'].' '.$dmGioChotBaoCao; // Y-m-d H:i:s
            }


            // ĐHSXKD
                $idThoiGianBaoCaoDhsxkd=0;
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->get()->toArray();
                if (count($thoiGianBaoCaoTheoDonVi)<=0) { // Nếu chưa có thì thêm vô và chốt luôn
                    $dataDmThoiGianBaoCao=array();
                    $dataDmThoiGianBaoCao['ma_don_vi']=$donVi['ma_don_vi'];
                    $dataDmThoiGianBaoCao['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                    $dataDmThoiGianBaoCao['id_tuan']=$idTuan;
                    $dataDmThoiGianBaoCao['thoi_gian_lay_so_lieu']=$thoiGianLaySoLieu;
                    $dataDmThoiGianBaoCao['thoi_gian_chot_so_lieu']=null;
                    $dataDmThoiGianBaoCao['ghi_chu']=null;
                    $dataDmThoiGianBaoCao['trang_thai']=0;
                    $bcDmThoiGianBaoCao=BcDmThoiGianBaoCao::create($dataDmThoiGianBaoCao);
                    $idThoiGianBaoCaoDhsxkd=$bcDmThoiGianBaoCao->id;
                }else{ //Ngược lại thì chốt
                    $idThoiGianBaoCaoDhsxkd=$thoiGianBaoCaoTheoDonVi[0]['id'];
                }
            // End DHSXKD
            
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $this->ma);
            $checkQuyenXemBaoCaoToanDonVi=BcPhanQuyenBaoCao::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'XEM_BAO_CAO_TOAN_DON_VI');
            if($checkQuyenXemBaoCaoToanDonVi===1 || $daChoSoLieu===2){               

                $baoCaoTuanHienTais=BcTuanHienTai::select('bc_tuan_hien_tai.id','bc_tuan_hien_tai.ma_don_vi','bc_tuan_hien_tai.ma_dinh_danh', 'bc_tuan_hien_tai.id_tuan', 'bc_tuan_hien_tai.id_user_bao_cao', 'bc_tuan_hien_tai.noi_dung', 'bc_tuan_hien_tai.thoi_gian_bao_cao', 'bc_tuan_hien_tai.ghi_chu', 'bc_tuan_hien_tai.is_group', 'bc_tuan_hien_tai.trang_thai', 'bc_tuan_hien_tai.sap_xep', 'bc_tuan_hien_tai.id_dich_vu')
                    ->leftJoin('dich_vu','bc_tuan_hien_tai.id_dich_vu','=','dich_vu.id')
                    ->where('bc_tuan_hien_tai.id_tuan','=',$idTuan)
                    ->where(function($query) {
                        $query->where('bc_tuan_hien_tai.ma_dinh_danh','=',$this->ma)->orWhere('bc_tuan_hien_tai.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_tuan_hien_tai.sap_xep','asc')
                    ->get()->toArray();

                $baoCaoKeHoachTuans=BcKeHoachTuan::select('bc_ke_hoach_tuan.id','bc_ke_hoach_tuan.ma_don_vi','bc_ke_hoach_tuan.ma_dinh_danh', 'bc_ke_hoach_tuan.id_tuan', 'bc_ke_hoach_tuan.id_user_bao_cao', 'bc_ke_hoach_tuan.noi_dung', 'bc_ke_hoach_tuan.thoi_gian_bao_cao', 'bc_ke_hoach_tuan.ghi_chu', 'bc_ke_hoach_tuan.is_group', 'bc_ke_hoach_tuan.trang_thai', 'bc_ke_hoach_tuan.id_dich_vu', 'bc_ke_hoach_tuan.sap_xep')
                    ->leftJoin('dich_vu','bc_ke_hoach_tuan.id_dich_vu','=','dich_vu.id')
                    ->where('bc_ke_hoach_tuan.id_tuan','=',$idTuan)
                    ->where(function($query) {
                        $query->where('bc_ke_hoach_tuan.ma_dinh_danh','=',$this->ma)->orWhere('bc_ke_hoach_tuan.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_ke_hoach_tuan.sap_xep','asc')
                    ->get()->toArray();
            }else{
                // Lấy lại số liệu báo cáo
                $dsDichVuTheoTaiKhoan=array();
                $dsDichVus=UsersDichVu::danhSachDichVuTheoTaiKhoan($userId);
                foreach ($dsDichVus as $key => $dichVu) {
                    $dsDichVuTheoTaiKhoan[$dichVu['id_dich_vu']]=$dichVu['id_dich_vu'];
                }

                $baoCaoTuanHienTais=BcTuanHienTai::select('bc_tuan_hien_tai.id','bc_tuan_hien_tai.ma_don_vi','bc_tuan_hien_tai.ma_dinh_danh', 'bc_tuan_hien_tai.id_tuan', 'bc_tuan_hien_tai.id_user_bao_cao', 'bc_tuan_hien_tai.noi_dung', 'bc_tuan_hien_tai.thoi_gian_bao_cao', 'bc_tuan_hien_tai.ghi_chu', 'bc_tuan_hien_tai.is_group', 'bc_tuan_hien_tai.trang_thai', 'bc_tuan_hien_tai.sap_xep', 'bc_tuan_hien_tai.id_dich_vu')
                    ->leftJoin('dich_vu','bc_tuan_hien_tai.id_dich_vu','=','dich_vu.id')
                    ->where('bc_tuan_hien_tai.id_tuan','=',$idTuan)->whereIn('bc_tuan_hien_tai.id_dich_vu',$dsDichVuTheoTaiKhoan)
                    ->where(function($query) {
                        $query->where('bc_tuan_hien_tai.ma_dinh_danh','=',$this->ma)->orWhere('bc_tuan_hien_tai.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_tuan_hien_tai.sap_xep','asc')
                    ->get()->toArray();

                $baoCaoKeHoachTuans=BcKeHoachTuan::select('bc_ke_hoach_tuan.id','bc_ke_hoach_tuan.ma_don_vi','bc_ke_hoach_tuan.ma_dinh_danh', 'bc_ke_hoach_tuan.id_tuan', 'bc_ke_hoach_tuan.id_user_bao_cao', 'bc_ke_hoach_tuan.noi_dung', 'bc_ke_hoach_tuan.thoi_gian_bao_cao', 'bc_ke_hoach_tuan.ghi_chu', 'bc_ke_hoach_tuan.is_group', 'bc_ke_hoach_tuan.trang_thai', 'bc_ke_hoach_tuan.id_dich_vu', 'bc_ke_hoach_tuan.sap_xep')
                    ->leftJoin('dich_vu','bc_ke_hoach_tuan.id_dich_vu','=','dich_vu.id')
                    ->where('bc_ke_hoach_tuan.id_tuan','=',$idTuan)->whereIn('bc_ke_hoach_tuan.id_dich_vu',$dsDichVuTheoTaiKhoan)
                    ->where(function($query) {
                        $query->where('bc_ke_hoach_tuan.ma_dinh_danh','=',$this->ma)->orWhere('bc_ke_hoach_tuan.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_ke_hoach_tuan.sap_xep','asc')
                    ->get()->toArray();
            }
            $checkQuyenBaoCaoDhsxkd=BcPhanQuyenBaoCao::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_DHSXKD');
            if($checkQuyenBaoCaoDhsxkd==1 || $daChoSoLieu===2){
                $baoCaoPakns=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PAKN');
            }else{
                $baoCaoPakns=array();
            }

            $view=view('BaoCaoTuan::don-vi-truc-thuoc-khac.danh-sach-bao-cao-tong-hop', compact('baoCaoPakns', 'baoCaoTuanHienTais', 'baoCaoKeHoachTuans','error','idTuan', 'ma', 'dmTuan', 'donVi', 'userId'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function baoCaoTuanChotSoLieu(Request $request){
       if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];

            $dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
            if(count($dmTuan)<=0){
                return array('error'=>"Lỗi không tìm thấy thời gian báo cáo");
            }
            $dmTuan=$dmTuan[0];

            $checkQuyenDuyetVaGuiBaoCao=BcPhanQuyenBaoCao::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'DUYET_VA_GUI_BAO_CAO');
            if(!$checkQuyenDuyetVaGuiBaoCao){
                return array('error'=>"Lỗi bạn không có quyền Duyệt và gửi báo cáo.");
            }

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];  
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{
                $ma=$donVi['ma_don_vi'];
            }

            $this->ma=$ma;
            // Kiểm tra đã chốt số liệu chưa
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
            //if($daChoSoLieu==1){
            if($daChoSoLieu==2){
                return array('error'=>"Chốt số liệu thất bại, do báo cáo đã được gửi nên không thể chỉnh sửa.");
            }
            

            $daVuotThoiGianChotSoLieu=BcDmThoiGianBaoCao::kiemTraVuotNgayChotSoLieu($idTuan);
            $thoiGianLaySoLieu=date('Y-m-d H:i:s');
            if($daVuotThoiGianChotSoLieu){
                $dmGioChotBaoCao=DmThamSoHeThong::getValueByName('BC_THOI_GIAN_CHOT_BAO_CAO');
                $thoiGianLaySoLieu=$dmTuan['den_ngay'].' '.$dmGioChotBaoCao; // Y-m-d H:i:s
            }

            // Chốt báo cáo tổng thể
            $idThoiGianBaoCaoDhsxkd=0;
            $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->get()->toArray();
            if (count($thoiGianBaoCaoTheoDonVi)<=0) { // Nếu chưa có thì thêm vô và chốt luôn
                $dataDmThoiGianBaoCao=array();
                $dataDmThoiGianBaoCao['ma_don_vi']=$donVi['ma_don_vi'];
                $dataDmThoiGianBaoCao['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataDmThoiGianBaoCao['id_tuan']=$idTuan;
                $dataDmThoiGianBaoCao['thoi_gian_lay_so_lieu']=$thoiGianLaySoLieu;
                $dataDmThoiGianBaoCao['thoi_gian_chot_so_lieu']=date('Y-m-d H:i:s');
                $dataDmThoiGianBaoCao['ghi_chu']=null;
                $dataDmThoiGianBaoCao['trang_thai']=2;
                $bcDmThoiGianBaoCao=BcDmThoiGianBaoCao::create($dataDmThoiGianBaoCao);
                $idThoiGianBaoCaoDhsxkd=$bcDmThoiGianBaoCao->id;

            }else{ //Ngược lại thì chốt
                $idThoiGianBaoCaoDhsxkd=$thoiGianBaoCaoTheoDonVi[0]['id'];
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['trang_thai'=>2, 'thoi_gian_chot_so_lieu'=>date('Y-m-d H:i:s')]);
            }
            // Chốt báo cáo tuần hiện tại
            BcTuanHienTai::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['trang_thai'=>2]);
            // Chốt kế hoạch tuần
            BcKeHoachTuan::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['trang_thai'=>2]);
            // Chốt số liệu ĐHSXKD
            BcDhsxkd::where('id_thoigian_baocao','=',$idThoiGianBaoCaoDhsxkd)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['trang_thai'=>2]);

            $message=$donVi['ten_don_vi'].': đã duyệt và gửi báo cáo tuần.';
            $sendTelegram=\Helper::sendTelegramMessage($message);

            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    // Chốt và gửi báo cáo tổng hợp
    public function xuatBaoCao(Request $request){
        $userId=0; $error=''; // Khai báo biến
        if(Auth::id()){
            $userId=Auth::id();
        }
        $data=RequestAjax::all(); // Lấy tất cả dữ liệu
        $idTuan=$data['tuan'];
        $dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
        if(count($dmTuan)<=0){
            return array('error'=>"Lỗi không tìm thấy thời gian báo cáo");
        }
        $dmTuan=$dmTuan[0];
        $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
        if ($donVi['error']>0) {
            return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
        }
        $donVi=$donVi['data'];       
        
        $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
        $ma=''; // Mã đơn vị hay mã định danh
        $baoCaoTuanHienTais=array();

        $idThoiGianBaoCaoDhsxkd=0; $baoCaoPakns=array();
        $thoiGianLaySoLieu='';
        if($baoCaoTheoMaDinhDanh==1){
            $ma=$donVi['ma_dinh_danh'];
        }else{ // Ngược lại báo cáo theo mã đơn vị
            $ma=$donVi['ma_don_vi'];
        }
        $this->ma=$ma;

        $daVuotThoiGianChotSoLieu=BcDmThoiGianBaoCao::kiemTraVuotNgayChotSoLieu($idTuan);
        $thoiGianLaySoLieu=date('Y-m-d H:i:s');
        if($daVuotThoiGianChotSoLieu){
            $dmGioChotBaoCao=DmThamSoHeThong::getValueByName('BC_THOI_GIAN_CHOT_BAO_CAO');
            $thoiGianLaySoLieu=$dmTuan['den_ngay'].' '.$dmGioChotBaoCao; // Y-m-d H:i:s
        }


        // ĐHSXKD
            $idThoiGianBaoCaoDhsxkd=0;
            $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
            })->get()->toArray();
            if (count($thoiGianBaoCaoTheoDonVi)<=0) { // Nếu chưa có thì thêm vô và chốt luôn
                $dataDmThoiGianBaoCao=array();
                $dataDmThoiGianBaoCao['ma_don_vi']=$donVi['ma_don_vi'];
                $dataDmThoiGianBaoCao['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataDmThoiGianBaoCao['id_tuan']=$idTuan;
                $dataDmThoiGianBaoCao['thoi_gian_lay_so_lieu']=$thoiGianLaySoLieu;
                $dataDmThoiGianBaoCao['thoi_gian_chot_so_lieu']=null;
                $dataDmThoiGianBaoCao['ghi_chu']=null;
                $dataDmThoiGianBaoCao['trang_thai']=0;
                $bcDmThoiGianBaoCao=BcDmThoiGianBaoCao::create($dataDmThoiGianBaoCao);
                $idThoiGianBaoCaoDhsxkd=$bcDmThoiGianBaoCao->id;
            }else{ //Ngược lại thì chốt
                $idThoiGianBaoCaoDhsxkd=$thoiGianBaoCaoTheoDonVi[0]['id'];
            }
        // End DHSXKD
        
        $checkQuyenXemBaoCaoToanDonVi=BcPhanQuyenBaoCao::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'XEM_BAO_CAO_TOAN_DON_VI');
        if($checkQuyenXemBaoCaoToanDonVi===1){                
            $baoCaoTuanHienTais=BcTuanHienTai::select('bc_tuan_hien_tai.id','bc_tuan_hien_tai.ma_don_vi','bc_tuan_hien_tai.ma_dinh_danh', 'bc_tuan_hien_tai.id_tuan', 'bc_tuan_hien_tai.id_user_bao_cao', 'bc_tuan_hien_tai.noi_dung', 'bc_tuan_hien_tai.thoi_gian_bao_cao', 'bc_tuan_hien_tai.ghi_chu', 'bc_tuan_hien_tai.is_group', 'bc_tuan_hien_tai.trang_thai', 'bc_tuan_hien_tai.sap_xep', 'bc_tuan_hien_tai.id_dich_vu')
                    ->leftJoin('dich_vu','bc_tuan_hien_tai.id_dich_vu','=','dich_vu.id')
                    ->where('bc_tuan_hien_tai.id_tuan','=',$idTuan)
                    ->where(function($query) {
                        $query->where('bc_tuan_hien_tai.ma_dinh_danh','=',$this->ma)->orWhere('bc_tuan_hien_tai.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_tuan_hien_tai.sap_xep','asc')
                    ->get()->toArray();

            $baoCaoKeHoachTuans=BcKeHoachTuan::select('bc_ke_hoach_tuan.id','bc_ke_hoach_tuan.ma_don_vi','bc_ke_hoach_tuan.ma_dinh_danh', 'bc_ke_hoach_tuan.id_tuan', 'bc_ke_hoach_tuan.id_user_bao_cao', 'bc_ke_hoach_tuan.noi_dung', 'bc_ke_hoach_tuan.thoi_gian_bao_cao', 'bc_ke_hoach_tuan.ghi_chu', 'bc_ke_hoach_tuan.is_group', 'bc_ke_hoach_tuan.trang_thai', 'bc_ke_hoach_tuan.id_dich_vu', 'bc_ke_hoach_tuan.sap_xep')
                ->leftJoin('dich_vu','bc_ke_hoach_tuan.id_dich_vu','=','dich_vu.id')
                ->where('bc_ke_hoach_tuan.id_tuan','=',$idTuan)
                ->where(function($query) {
                    $query->where('bc_ke_hoach_tuan.ma_dinh_danh','=',$this->ma)->orWhere('bc_ke_hoach_tuan.ma_don_vi','=',$this->ma);
                })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_ke_hoach_tuan.sap_xep','asc')
                ->get()->toArray();
        }else{
            // Lấy lại số liệu báo cáo
            $dsDichVuTheoTaiKhoan=array();
            $dsDichVus=UsersDichVu::danhSachDichVuTheoTaiKhoan($userId);
            foreach ($dsDichVus as $key => $dichVu) {
                $dsDichVuTheoTaiKhoan[$dichVu['id_dich_vu']]=$dichVu['id_dich_vu'];
            }
            
            $baoCaoTuanHienTais=BcTuanHienTai::select('bc_tuan_hien_tai.id','bc_tuan_hien_tai.ma_don_vi','bc_tuan_hien_tai.ma_dinh_danh', 'bc_tuan_hien_tai.id_tuan', 'bc_tuan_hien_tai.id_user_bao_cao', 'bc_tuan_hien_tai.noi_dung', 'bc_tuan_hien_tai.thoi_gian_bao_cao', 'bc_tuan_hien_tai.ghi_chu', 'bc_tuan_hien_tai.is_group', 'bc_tuan_hien_tai.trang_thai', 'bc_tuan_hien_tai.sap_xep', 'bc_tuan_hien_tai.id_dich_vu')
                    ->leftJoin('dich_vu','bc_tuan_hien_tai.id_dich_vu','=','dich_vu.id')
                    ->where('bc_tuan_hien_tai.id_tuan','=',$idTuan)->whereIn('bc_tuan_hien_tai.id_dich_vu',$dsDichVuTheoTaiKhoan)
                    ->where(function($query) {
                        $query->where('bc_tuan_hien_tai.ma_dinh_danh','=',$this->ma)->orWhere('bc_tuan_hien_tai.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_tuan_hien_tai.sap_xep','asc')
                    ->get()->toArray();

            $baoCaoKeHoachTuans=BcKeHoachTuan::select('bc_ke_hoach_tuan.id','bc_ke_hoach_tuan.ma_don_vi','bc_ke_hoach_tuan.ma_dinh_danh', 'bc_ke_hoach_tuan.id_tuan', 'bc_ke_hoach_tuan.id_user_bao_cao', 'bc_ke_hoach_tuan.noi_dung', 'bc_ke_hoach_tuan.thoi_gian_bao_cao', 'bc_ke_hoach_tuan.ghi_chu', 'bc_ke_hoach_tuan.is_group', 'bc_ke_hoach_tuan.trang_thai', 'bc_ke_hoach_tuan.id_dich_vu', 'bc_ke_hoach_tuan.sap_xep')
                ->leftJoin('dich_vu','bc_ke_hoach_tuan.id_dich_vu','=','dich_vu.id')
                ->where('bc_ke_hoach_tuan.id_tuan','=',$idTuan)->whereIn('bc_ke_hoach_tuan.id_dich_vu',$dsDichVuTheoTaiKhoan)
                ->where(function($query) {
                    $query->where('bc_ke_hoach_tuan.ma_dinh_danh','=',$this->ma)->orWhere('bc_ke_hoach_tuan.ma_don_vi','=',$this->ma);
                })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_ke_hoach_tuan.sap_xep','asc')
                ->get()->toArray();
        }
        $checkQuyenBaoCaoDhsxkd=BcPhanQuyenBaoCao::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'BAO_CAO_DHSXKD');
        if($checkQuyenBaoCaoDhsxkd==1){
            $baoCaoPakns=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PAKN');
        }else{
            $baoCaoPakns=array();
        }
        
        return view('BaoCaoTuan::don-vi-truc-thuoc-khac.xuat-bao-cao', compact('baoCaoPakns', 'baoCaoTuanHienTais', 'baoCaoKeHoachTuans','error','idTuan', 'ma', 'dmTuan', 'donVi', 'userId')); // Trả dữ liệu ra view 
    }
    

    
    public function chenBaoCaoTuanHienTai(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id_tuan'];
            $idDichVu=$data['id_dich_vu'];
            $idBaoCaoTruoc=$data['id_bao_cao_truoc'];

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];  
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{
                $ma=$donVi['ma_don_vi'];
            }
            // Kiểm tra đã chốt số liệu chưa
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
            //if($daChoSoLieu==1){
            if($daChoSoLieu==2){
                return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
            }
            $checkExits=BcTuanHienTai::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('id_dich_vu','=',$idDichVu)->where('noi_dung','=',$data['noi_dung'])->get()->toArray();
            $baoCaoTruoc=BcTuanHienTai::find($idBaoCaoTruoc);
            $isGroupTruoc=0;
            $sapXepTruoc=0;
            if($baoCaoTruoc){
                $isGroupTruoc=$baoCaoTruoc->is_group-1;
                $sapXepTruoc=$baoCaoTruoc->sap_xep;
                if($isGroupTruoc<0){
                    $isGroupTruoc=0;
                }
            }
            $idBaoCaoTuan=0;
            if(count($checkExits)<=0){
                $dataBaoCaoTuan=array();
                $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                $dataBaoCaoTuan['noi_dung']=$data['noi_dung'];
                $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                $dataBaoCaoTuan['ghi_chu']=null;
                $dataBaoCaoTuan['id_dich_vu']=$idDichVu;
                $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                $dataBaoCaoTuan['trang_thai']=0;
                $dataBaoCaoTuan['is_group']=$isGroupTruoc;
                $dataBaoCaoTuan['sap_xep']=0;
                $baoCaoTuan=BcTuanHienTai::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                $sapXep=$baoCaoTuan->id;
                $baoCaoTuan->sap_xep=$sapXep;
                $baoCaoTuan->save();
                $idBaoCaoTuan=$baoCaoTuan->id;                    
            }else{
                return  array('error'=>"Chèn dữ liệu thất bại");
            }
            $dsBaoCaos=BcTuanHienTai::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('sap_xep','>',$sapXepTruoc)->where('id','!=',$idBaoCaoTuan)->orderBy('sap_xep','asc')->get()->toArray();
            $soLuongBaoCaoCanSuaViTri=count($dsBaoCaos);
            if($soLuongBaoCaoCanSuaViTri>0){
                $baoCaoTuan=BcTuanHienTai::find($idBaoCaoTuan);
                $baoCaoTuan->sap_xep=$dsBaoCaos[0]['sap_xep'];
                $baoCaoTuan->save();
                foreach ($dsBaoCaos as $key => $baoCao) {
                    $sttKeTiep=$key+1;
                    $sapXep=1000;
                    if($sttKeTiep<$soLuongBaoCaoCanSuaViTri){
                        $sapXep=$dsBaoCaos[$sttKeTiep]['sap_xep'];
                    }else{
                        $sapXep=$baoCaoTuan->id;
                    }

                    $bcCanSuaViTri=BcTuanHienTai::find($baoCao['id']);
                    //$bcCanSuaViTri->id=$sapXep;
                    $bcCanSuaViTri->sap_xep=$sapXep;
                    $bcCanSuaViTri->save();
                }
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function chenKeHoachTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id_tuan'];
            $idDichVu=$data['id_dich_vu'];
            $idBaoCaoTruoc=$data['id_bao_cao_truoc'];

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'KHAC');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];  
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
            }else{
                $ma=$donVi['ma_don_vi'];
            }
            // Kiểm tra đã chốt số liệu chưa
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
            //if($daChoSoLieu==1){
            if($daChoSoLieu==2){
                return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
            }

            $baoCaoTruoc=BcKeHoachTuan::find($idBaoCaoTruoc);
            $isGroupTruoc=0;
            $sapXepTruoc=0;
            if($baoCaoTruoc){
                $isGroupTruoc=$baoCaoTruoc->is_group-1;
                $sapXepTruoc=$baoCaoTruoc->sap_xep;
                if($isGroupTruoc<0){
                    $isGroupTruoc=0;
                }
            }
            $idBaoCaoTuan;

            $checkExits=BcKeHoachTuan::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('noi_dung','=',$data['noi_dung'])->get()->toArray();
            if(count($checkExits)<=0){
                $dataBaoCaoTuan=array();
                $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                $dataBaoCaoTuan['noi_dung']=$data['noi_dung'];
                $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                $dataBaoCaoTuan['id_dich_vu']=$idDichVu;
                $dataBaoCaoTuan['ghi_chu']=null;
                $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                $dataBaoCaoTuan['trang_thai']=0;
                $dataBaoCaoTuan['is_group']=$isGroupTruoc;
                $dataBaoCaoTuan['sap_xep']=0;
                $baoCaoTuan=BcKeHoachTuan::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                $sapXep=$baoCaoTuan->id;
                $baoCaoTuan->sap_xep=$sapXep;
                $baoCaoTuan->save();
                $idBaoCaoTuan=$baoCaoTuan->id;
            }

            $dsBaoCaos=BcKeHoachTuan::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('sap_xep','>',$sapXepTruoc)->where('id','!=',$idBaoCaoTuan)->orderBy('sap_xep','asc')->get()->toArray();
            $soLuongBaoCaoCanSuaViTri=count($dsBaoCaos);
            if($soLuongBaoCaoCanSuaViTri>0){
                $baoCaoTuan=BcKeHoachTuan::find($idBaoCaoTuan);
                $baoCaoTuan->sap_xep=$dsBaoCaos[0]['sap_xep'];
                $baoCaoTuan->save();
                foreach ($dsBaoCaos as $key => $baoCao) {
                    $sttKeTiep=$key+1;
                    $sapXep=1000;
                    if($sttKeTiep<$soLuongBaoCaoCanSuaViTri){
                        $sapXep=$dsBaoCaos[$sttKeTiep]['sap_xep'];
                    }else{
                        $sapXep=$baoCaoTuan->id;
                    }

                    $bcCanSuaViTri=BcKeHoachTuan::find($baoCao['id']);
                    //$bcCanSuaViTri->id=$sapXep;
                    $bcCanSuaViTri->sap_xep=$sapXep;
                    $bcCanSuaViTri->save();
                }
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function baoCaoTuanHienTaiDiChuyenLen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idBaoCaoHienTai=$data['id'];            
            $baoCaoHienTai=BcTuanHienTai::find($idBaoCaoHienTai);
            if($baoCaoHienTai){
                $sapXepHienTai=$baoCaoHienTai->sap_xep;
                $idDichVuHienTai=$baoCaoHienTai->id_dich_vu;
                $idTuan=$baoCaoHienTai->id_tuan;
                $baoCaoTruoc=BcTuanHienTai::where('sap_xep','<',$sapXepHienTai)->where('id_dich_vu','=',$idDichVuHienTai)->where('is_group','!=',3)->where('id_tuan','=',$idTuan)->orderBy('sap_xep','desc')->first();
                if($baoCaoTruoc){
                    $sapXepTruoc=$baoCaoTruoc->sap_xep;
                    $baoCaoTruoc->sap_xep=$sapXepHienTai;
                    $baoCaoTruoc->save();
                    $baoCaoHienTai->sap_xep=$sapXepTruoc;
                    $baoCaoHienTai->save();
                }

            }else{ 
                return array("error"=>'Không tìm thấy báo cáo cần di chuyển');
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function baoCaoTuanHienTaiDiChuyenXuong(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idBaoCaoHienTai=$data['id'];            
            $baoCaoHienTai=BcTuanHienTai::find($idBaoCaoHienTai);
            if($baoCaoHienTai){
                $sapXepHienTai=$baoCaoHienTai->sap_xep;
                $idDichVuHienTai=$baoCaoHienTai->id_dich_vu;
                $idTuan=$baoCaoHienTai->id_tuan;
                $baoCaoSau=BcTuanHienTai::where('sap_xep','>',$sapXepHienTai)->where('id_dich_vu','=',$idDichVuHienTai)->where('is_group','!=',3)->where('id_tuan','=',$idTuan)->orderBy('sap_xep','asc')->first();
                if($baoCaoSau){
                    $sapXepSau=$baoCaoSau->sap_xep;
                    $baoCaoSau->sap_xep=$sapXepHienTai;
                    $baoCaoSau->save();
                    $baoCaoHienTai->sap_xep=$sapXepSau;
                    $baoCaoHienTai->save();
                }

            }else{ 
                return array("error"=>'Không tìm thấy báo cáo cần di chuyển');
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function keHoachTuanDiChuyenLen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idBaoCaoHienTai=$data['id'];            
            $baoCaoHienTai=BcKeHoachTuan::find($idBaoCaoHienTai);
            if($baoCaoHienTai){
                $sapXepHienTai=$baoCaoHienTai->sap_xep;
                $idDichVuHienTai=$baoCaoHienTai->id_dich_vu;
                $idTuan=$baoCaoHienTai->id_tuan;
                $baoCaoTruoc=BcKeHoachTuan::where('sap_xep','<',$sapXepHienTai)->where('id_dich_vu','=',$idDichVuHienTai)->where('is_group','!=',3)->where('id_tuan','=',$idTuan)->orderBy('sap_xep','desc')->first();
                if($baoCaoTruoc){
                    $sapXepTruoc=$baoCaoTruoc->sap_xep;
                    $baoCaoTruoc->sap_xep=$sapXepHienTai;
                    $baoCaoTruoc->save();
                    $baoCaoHienTai->sap_xep=$sapXepTruoc;
                    $baoCaoHienTai->save();
                }

            }else{ 
                return array("error"=>'Không tìm thấy báo cáo cần di chuyển');
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function keHoachTuanDiChuyenXuong(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idBaoCaoHienTai=$data['id'];            
            $baoCaoHienTai=BcKeHoachTuan::find($idBaoCaoHienTai);
            if($baoCaoHienTai){
                $sapXepHienTai=$baoCaoHienTai->sap_xep;
                $idDichVuHienTai=$baoCaoHienTai->id_dich_vu;
                $idTuan=$baoCaoHienTai->id_tuan;
                $baoCaoSau=BcKeHoachTuan::where('sap_xep','>',$sapXepHienTai)->where('id_dich_vu','=',$idDichVuHienTai)->where('is_group','!=',3)->where('id_tuan','=',$idTuan)->orderBy('sap_xep','asc')->first();
                if($baoCaoSau){
                    $sapXepSau=$baoCaoSau->sap_xep;
                    $baoCaoSau->sap_xep=$sapXepHienTai;
                    $baoCaoSau->save();
                    $baoCaoHienTai->sap_xep=$sapXepSau;
                    $baoCaoHienTai->save();
                }

            }else{ 
                return array("error"=>'Không tìm thấy báo cáo cần di chuyển');
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }
    
}