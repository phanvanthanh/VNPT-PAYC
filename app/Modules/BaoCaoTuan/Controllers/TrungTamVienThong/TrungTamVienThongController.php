<?php
namespace App\Modules\BaoCaoTuan\Controllers\TrungTamVienThong;

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
use App\Helpers\Helper;
use GuzzleHttp\Client;

class TrungTamVienThongController extends Controller{
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

        $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
        if ($donVi['error']>0) {
            abort(403, 'Tài khoản không có quyền báo cáo.');
        }
        $donVi=$donVi['data'];


        return view('BaoCaoTuan::trung-tam-vien-thong.bao-cao-tuan',compact('bcDmTuan', 'donVi'));
    }


    // Báo cáo tuần hiện tại
    public function danhSachBaoCaoTuanHienTai(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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
            $baoCaos=BcTuanHienTai::select('bc_tuan_hien_tai.id','bc_tuan_hien_tai.ma_don_vi','bc_tuan_hien_tai.ma_dinh_danh', 'bc_tuan_hien_tai.id_tuan', 'bc_tuan_hien_tai.id_user_bao_cao', 'bc_tuan_hien_tai.noi_dung', 'bc_tuan_hien_tai.thoi_gian_bao_cao', 'bc_tuan_hien_tai.ghi_chu', 'bc_tuan_hien_tai.is_group', 'bc_tuan_hien_tai.trang_thai', 'bc_tuan_hien_tai.sap_xep', 'bc_tuan_hien_tai.id_dich_vu')
                    ->leftJoin('dich_vu','bc_tuan_hien_tai.id_dich_vu','=','dich_vu.id')
                    ->where('bc_tuan_hien_tai.id_tuan','=',$idTuan)
                    ->where(function($query) {
                        $query->where('bc_tuan_hien_tai.ma_dinh_danh','=',$this->ma)->orWhere('bc_tuan_hien_tai.ma_don_vi','=',$this->ma);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_tuan_hien_tai.sap_xep','asc')
                    ->get()->toArray();
            $view=view('BaoCaoTuan::trung-tam-vien-thong.danh-sach-bao-cao-tuan-hien-tai', compact('baoCaos','error','idTuan', 'ma'))->render(); // Trả dữ liệu ra view 
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

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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
            if($daChoSoLieu==1){
                return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
            }
            
            $checkExits=BcTuanHienTai::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('noi_dung','=',$data['noi_dung'])->get()->toArray();
            if(count($checkExits)<=0){
                if(strstr($data['noi_dung'], "\n")) {
                    $newStrings=explode("\n", $data['noi_dung']);
                    foreach($newStrings as $key => $string){
                        if(strlen(trim($string," "))>1){
                            $dataBaoCaoTuan=array();
                            $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                            $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                            $dataBaoCaoTuan['noi_dung']=$string;
                            $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataBaoCaoTuan['ghi_chu']=null;
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
                }else{
                    $dataBaoCaoTuan=array();
                    $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                    $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                    $dataBaoCaoTuan['noi_dung']=$data['noi_dung'];
                    $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                    $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                    $dataBaoCaoTuan['ghi_chu']=null;
                    $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                    $dataBaoCaoTuan['trang_thai']=0;
                    $dataBaoCaoTuan['is_group']=2;
                    $dataBaoCaoTuan['sap_xep']=0;
                    $baoCaoTuan=BcTuanHienTai::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                    $sapXep=$baoCaoTuan->id;
                    $baoCaoTuan->sap_xep=$sapXep;
                    $baoCaoTuan->save();
                }
                
            }else{
                return array("error"=>'Nội dung này đã tồn tại');
            }

            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
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
                if($daChoSoLieu==1){
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
                if($daChoSoLieu==1){
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

    public function layDuLieuTuKeHoachTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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
            if($daChoSoLieu==1){
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
            $keHoachTuanTruocs=BcKeHoachTuan::where('id_tuan','=',$idTuanTruoc)->where(function($query) {
                $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
            })->get()->toArray();
            foreach ($keHoachTuanTruocs as $key => $keHoachTuanTruoc) {
                $dataBaoCaoTuan=array();
                $dataBaoCaoTuan['id_tuan']=$idTuan;
                $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                $dataBaoCaoTuan['noi_dung']=$keHoachTuanTruoc['noi_dung'];
                $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                $dataBaoCaoTuan['ghi_chu']=null;
                $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                $dataBaoCaoTuan['trang_thai']=0;
                $dataBaoCaoTuan['is_group']=$keHoachTuanTruoc['is_group'];
                $dataBaoCaoTuan['sap_xep']=$keHoachTuanTruoc['sap_xep'];
                $baoCaoTuan=BcTuanHienTai::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                $sapXep=$baoCaoTuan->id;
                $baoCaoTuan->sap_xep=$sapXep;
                $baoCaoTuan->save();
            }

                
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
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
            $idTuan=$data['id'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi ".$donVi['message']); // Trả về lỗi phương thức truyền số liệu
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
            $baoCaos=BcKeHoachTuan::select('bc_ke_hoach_tuan.id','bc_ke_hoach_tuan.ma_don_vi','bc_ke_hoach_tuan.ma_dinh_danh', 'bc_ke_hoach_tuan.id_tuan', 'bc_ke_hoach_tuan.id_user_bao_cao', 'bc_ke_hoach_tuan.noi_dung', 'bc_ke_hoach_tuan.thoi_gian_bao_cao', 'bc_ke_hoach_tuan.ghi_chu', 'bc_ke_hoach_tuan.is_group', 'bc_ke_hoach_tuan.trang_thai', 'bc_ke_hoach_tuan.id_dich_vu', 'bc_ke_hoach_tuan.sap_xep')
                ->leftJoin('dich_vu','bc_ke_hoach_tuan.id_dich_vu','=','dich_vu.id')
                ->where('bc_ke_hoach_tuan.id_tuan','=',$idTuan)
                ->where(function($query) {
                    $query->where('bc_ke_hoach_tuan.ma_dinh_danh','=',$this->ma)->orWhere('bc_ke_hoach_tuan.ma_don_vi','=',$this->ma);
                })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_ke_hoach_tuan.sap_xep','asc')
                ->get()->toArray();
            $view=view('BaoCaoTuan::trung-tam-vien-thong.danh-sach-bao-cao-ke-hoach-tuan', compact('baoCaos','error','idTuan', 'ma'))->render(); // Trả dữ liệu ra view 
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

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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
            if($daChoSoLieu==1){
                return array('error'=>"Lỗi đã chốt số liệu nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
            }


            $checkExits=BcKeHoachTuan::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('noi_dung','=',$data['noi_dung'])->get()->toArray();
            if(count($checkExits)<=0){
                if(strstr($data['noi_dung'], "\n")) {
                    $newStrings=explode("\n", $data['noi_dung']);
                    foreach($newStrings as $key => $string){
                        if(strlen(trim($string," "))>1){
                            $dataBaoCaoTuan=array();
                            $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                            $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                            $dataBaoCaoTuan['noi_dung']=$string;
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
                else{
                    $dataBaoCaoTuan=array();
                    $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                    $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                    $dataBaoCaoTuan['noi_dung']=$data['noi_dung'];
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
                
            }else{
                return array("error"=>'Nội dung này đã tồn tại');
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
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
                if($daChoSoLieu==1){
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
                if($daChoSoLieu==1){
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
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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

            $idThoiGianBaoCaoDhsxkd=0;
            $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->get()->toArray();
            if (count($thoiGianBaoCaoTheoDonVi)<=0) { // Nếu chưa có thì thêm vô và chốt luôn
                $dataDmThoiGianBaoCao=array();
                $dataDmThoiGianBaoCao['ma_don_vi']=$donVi['ma_don_vi'];
                $dataDmThoiGianBaoCao['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataDmThoiGianBaoCao['id_tuan']=$idTuan;
                $dataDmThoiGianBaoCao['thoi_gian_lay_so_lieu']=date('Y-m-d H:i:s');
                $dataDmThoiGianBaoCao['thoi_gian_chot_so_lieu']=null;
                $dataDmThoiGianBaoCao['ghi_chu']=null;
                $dataDmThoiGianBaoCao['trang_thai']=0;
                $bcDmThoiGianBaoCao=BcDmThoiGianBaoCao::create($dataDmThoiGianBaoCao);
                $idThoiGianBaoCaoDhsxkd=$bcDmThoiGianBaoCao->id;
                $thoiGianLaySoLieu=$bcDmThoiGianBaoCao->thoi_gian_lay_so_lieu;

            }else{ //Ngược lại thì chốt
                $idThoiGianBaoCaoDhsxkd=$thoiGianBaoCaoTheoDonVi[0]['id'];
                $thoiGianLaySoLieu=date('Y-m-d H:i:s');
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['thoi_gian_lay_so_lieu'=>$thoiGianLaySoLieu]);
            }
            $baoCaoPakns=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PAKN');

            // Lấy ngày lấy số liệu của tuần trước
            
            $tuan=0; $nam=0;
            $dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
            if(count($dmTuan)>0){
                $tuan=$dmTuan[0]['tuan'];
                $nam=$dmTuan[0]['nam'];
            }
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
            $view=view('BaoCaoTuan::trung-tam-vien-thong.danh-sach-bao-cao-dhsxkd', compact('baoCaoPakns','error','idTuan', 'ma', 'thoiGianLaySoLieu', 'ngayLayDuLieuTuanTruoc'))->render(); // Trả dữ liệu ra view 
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
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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



            
            // Nếu chưa chốt số liệu thì cho lấy số liệu
            // Ngược lại không lấy
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
            if($daChoSoLieu==0){
                $thoiGianLaySoLieu=date('Y-m-d H:i:s');
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
                $tuan=0; $nam=0;
                $dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
                if(count($dmTuan)>0){
                    $tuan=$dmTuan[0]['tuan'];
                    $nam=$dmTuan[0]['nam'];
                }
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
                /*$dataDhsxkd=array();
                $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                $dataDhsxkd['id_user_bao_cao']=$userId;
                $dataDhsxkd['chi_so']='XU_LY_PAKN';
                $dataDhsxkd['gia_tri']=10;
                $dataDhsxkd['is_group']=0;
                $dataDhsxkd['ghi_chu']='';
                $dataDhsxkd['loai_chi_so']='PAKN';
                $dataDhsxkd['trang_thai']=0;
                $dataDhsxkd['sap_xep']=0;
                $bcDhsxkd=BcDhsxkd::create($dataDhsxkd);


                $dataDhsxkd=array();
                $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                $dataDhsxkd['id_user_bao_cao']=$userId;
                $dataDhsxkd['is_group']=0;
                $dataDhsxkd['ghi_chu']='';
                $dataDhsxkd['trang_thai']=0;
                $dataDhsxkd['sap_xep']=0;
                $dataDhsxkd['chi_so']='PAKN_CHUA_XU_LY';
                $dataDhsxkd['gia_tri']=11;
                $dataDhsxkd['loai_chi_so']='PAKN';
                $bcDhsxkd=BcDhsxkd::create($dataDhsxkd);

                
                $dataDhsxkd=array();
                $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                $dataDhsxkd['id_user_bao_cao']=$userId;
                $dataDhsxkd['is_group']=0;
                $dataDhsxkd['ghi_chu']='';
                $dataDhsxkd['trang_thai']=0;
                $dataDhsxkd['sap_xep']=0;
                $dataDhsxkd['chi_so']='PAKN_DANG_XU_LY';
                $dataDhsxkd['gia_tri']=11;
                $dataDhsxkd['loai_chi_so']='PAKN';
                $bcDhsxkd2=BcDhsxkd::create($dataDhsxkd);

                $dataDhsxkd=array();
                $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                $dataDhsxkd['id_user_bao_cao']=$userId;
                $dataDhsxkd['is_group']=0;
                $dataDhsxkd['ghi_chu']='';
                $dataDhsxkd['trang_thai']=0;
                $dataDhsxkd['sap_xep']=0;
                $dataDhsxkd['chi_so']='PAKN_DA_XU_LY';
                $dataDhsxkd['gia_tri']=11;
                $dataDhsxkd['loai_chi_so']='PAKN';
                $bcDhsxkd6=BcDhsxkd::create($dataDhsxkd);*/
            }else{ 

            }

            return array('error'=>""); // Trả về lỗi phương thức truyền số liệu
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }
    // End báo cáo dhsxkd

    // Chốt và gửi báo cáo tổng hợp
    protected $maDonViCon='';
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
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];       
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma=''; // Mã đơn vị hay mã định danh
            $baoCaoTuanHienTais=array();

            // ĐHSXKD
            $idThoiGianBaoCaoDhsxkd=0; $baoCaoPakns=array();
            $thoiGianLaySoLieu='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
                
            }else{ // Ngược lại báo cáo theo mã đơn vị
                $ma=$donVi['ma_don_vi'];                
            }// End DHSXKD

            $this->ma=$ma;

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
                    $dataDmThoiGianBaoCao['thoi_gian_lay_so_lieu']=date('Y-m-d H:i:s');
                    $dataDmThoiGianBaoCao['thoi_gian_chot_so_lieu']=null;
                    $dataDmThoiGianBaoCao['ghi_chu']=null;
                    $dataDmThoiGianBaoCao['trang_thai']=0;
                    $bcDmThoiGianBaoCao=BcDmThoiGianBaoCao::create($dataDmThoiGianBaoCao);
                    $idThoiGianBaoCaoDhsxkd=$bcDmThoiGianBaoCao->id;
                    $thoiGianLaySoLieu=$bcDmThoiGianBaoCao->thoi_gian_lay_so_lieu;

                }else{ //Ngược lại thì chốt
                    $idThoiGianBaoCaoDhsxkd=$thoiGianBaoCaoTheoDonVi[0]['id'];
                    $thoiGianLaySoLieu=date('Y-m-d H:i:s');
                    $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                    })->update(['thoi_gian_lay_so_lieu'=>$thoiGianLaySoLieu]);
                }
                $baoCaoPakns=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PAKN');
                // End DHSXKD



            $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
            })->get()->toArray();
            $trangThaiChotBaoCao=0; // Trạng thái chốt báo cáo đơn vị cha
            if($thoiGianBaoCaoTheoDonVi){
                $trangThaiChotBaoCao=$thoiGianBaoCaoTheoDonVi[0]['trang_thai'];
            }


            // Tổng hợp số liệu của các tổ (huyện)
            $danhSachDonVis=DonVi::all()->toArray();
            $dsDonViCons=\Helper::layDonViConTheoMaCap($danhSachDonVis, $donVi['id'], 'HUYEN');
            $tongHopBaoCaoCapHuyens=array();

            foreach ($dsDonViCons as $key => $donViCon) {                
                $maDonViCon='';
                $baoCaoCapHuyens=array();
                if($baoCaoTheoMaDinhDanh==1){
                    $maDonViCon=$donViCon['ma_dinh_danh'];
                }else{
                    $maDonViCon=$donViCon['ma_don_vi'];
                }
                $this->maDonViCon=$maDonViCon;
                $thoiGianBaoCaoDhsxkdTheoDonViCon=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->maDonViCon)->orWhere('ma_don_vi','=',$this->maDonViCon);
                    })->get()->toArray();
                $idThoiGianBaoCaoDhsxkdDonViCon=0;
                $trangThaiBaoCaoDonViCon=0;
                $thoiGianChotSoLieuDonViCon='';
                if($thoiGianBaoCaoDhsxkdTheoDonViCon){
                    $idThoiGianBaoCaoDhsxkdDonViCon=$thoiGianBaoCaoDhsxkdTheoDonViCon[0]['id'];
                    $trangThaiBaoCaoDonViCon=$thoiGianBaoCaoDhsxkdTheoDonViCon[0]['trang_thai'];
                    $thoiGianChotSoLieuDonViCon=$thoiGianBaoCaoDhsxkdTheoDonViCon[0]['thoi_gian_chot_so_lieu'];
                }
                $donViCon['trang_thai_chot_bao_cao']=$trangThaiBaoCaoDonViCon;
                $donViCon['thoi_gian_chot_so_lieu']=$thoiGianChotSoLieuDonViCon;
                $baoCaoCapHuyens['thong_tin_don_vi']=$donViCon;
                if($trangThaiBaoCaoDonViCon>0){
                    // $baoCaoCapHuyenPhatTrienMois=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'PHAT_TRIEN_MOI');
                    // $baoCaoCapHuyenXuLySuyHaos=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'XU_LY_SUY_HAO');

                    $baoCaoCapHuyenPhatTrienMois=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'PHAT_TRIEN_MOI');
                    $baoCaoCapHuyenXuLySuyHaos=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'XU_LY_SUY_HAO');
                    $baoCaoCapHuyenGoiHomes=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'GOI_HOME');
                    $baoCaoCapHuyenXuLyDungHans=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'XU_LU_DUNG_HAN');
                    $baoCaoCapHuyenMLLs=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'MLL');
                    $baoCaoCapHuyenB2As=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'B2A');
                    $baoCaoCapHuyenDoHaiLongs=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'HAI_LONG');

                    

                    $baoCaoCapHuyenTuanHienTais=BcTuanHienTai::select('bc_tuan_hien_tai.id','bc_tuan_hien_tai.ma_don_vi','bc_tuan_hien_tai.ma_dinh_danh', 'bc_tuan_hien_tai.id_tuan', 'bc_tuan_hien_tai.id_user_bao_cao', 'bc_tuan_hien_tai.noi_dung', 'bc_tuan_hien_tai.thoi_gian_bao_cao', 'bc_tuan_hien_tai.ghi_chu', 'bc_tuan_hien_tai.is_group', 'bc_tuan_hien_tai.trang_thai', 'bc_tuan_hien_tai.sap_xep', 'bc_tuan_hien_tai.id_dich_vu')
                    ->leftJoin('dich_vu','bc_tuan_hien_tai.id_dich_vu','=','dich_vu.id')
                    ->where('bc_tuan_hien_tai.id_tuan','=',$idTuan)
                    ->where(function($query) {
                        $query->where('bc_tuan_hien_tai.ma_dinh_danh','=',$this->maDonViCon)->orWhere('bc_tuan_hien_tai.ma_don_vi','=',$this->maDonViCon);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_tuan_hien_tai.sap_xep','asc')
                    ->get()->toArray();
                    $baoCaoCapHuyenKeHoachTuans=BcKeHoachTuan::select('bc_ke_hoach_tuan.id','bc_ke_hoach_tuan.ma_don_vi','bc_ke_hoach_tuan.ma_dinh_danh', 'bc_ke_hoach_tuan.id_tuan', 'bc_ke_hoach_tuan.id_user_bao_cao', 'bc_ke_hoach_tuan.noi_dung', 'bc_ke_hoach_tuan.thoi_gian_bao_cao', 'bc_ke_hoach_tuan.ghi_chu', 'bc_ke_hoach_tuan.is_group', 'bc_ke_hoach_tuan.trang_thai', 'bc_ke_hoach_tuan.id_dich_vu', 'bc_ke_hoach_tuan.sap_xep')
                        ->leftJoin('dich_vu','bc_ke_hoach_tuan.id_dich_vu','=','dich_vu.id')
                        ->where('bc_ke_hoach_tuan.id_tuan','=',$idTuan)
                        ->where(function($query) {
                            $query->where('bc_ke_hoach_tuan.ma_dinh_danh','=',$this->maDonViCon)->orWhere('bc_ke_hoach_tuan.ma_don_vi','=',$this->maDonViCon);
                        })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_ke_hoach_tuan.sap_xep','asc')
                        ->get()->toArray();

                    
                    $baoCaoCapHuyens['ke_hoach_tuan']=$baoCaoCapHuyenKeHoachTuans;
                    $baoCaoCapHuyens['tuan_hien_tai']=$baoCaoCapHuyenTuanHienTais;

                    $baoCaoCapHuyens['phat_trien_moi']=$baoCaoCapHuyenPhatTrienMois;
                    $baoCaoCapHuyens['xu_ly_suy_hao']=$baoCaoCapHuyenXuLySuyHaos;

                    $baoCaoCapHuyens['goi_home']=$baoCaoCapHuyenGoiHomes;
                    $baoCaoCapHuyens['xu_ly_dung_han']=$baoCaoCapHuyenXuLyDungHans;
                    $baoCaoCapHuyens['mll']=$baoCaoCapHuyenMLLs;
                    $baoCaoCapHuyens['b2a']=$baoCaoCapHuyenB2As;
                    $baoCaoCapHuyens['hai_long']=$baoCaoCapHuyenDoHaiLongs;
                    
                }
                $tongHopBaoCaoCapHuyens[]=$baoCaoCapHuyens;
            }
            

            $view=view('BaoCaoTuan::trung-tam-vien-thong.danh-sach-bao-cao-tong-hop', compact('baoCaoPakns', 'baoCaoTuanHienTais', 'baoCaoKeHoachTuans','error','idTuan', 'ma', 'dmTuan', 'donVi', 'userId', 'tongHopBaoCaoCapHuyens', 'trangThaiChotBaoCao'))->render(); // Trả dữ liệu ra view 
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

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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
            if($daChoSoLieu==1){
                return array('error'=>"Chốt số liệu thất bại, do báo cáo đã được gửi nên không thể chỉnh sửa.");
            }
            // // Kiểm tra vượt thời gian gửi báo cáo
            // $daVuotThoiGianBaoCao=BcDmThoiGianBaoCao::kiemTraVuotNgayChotSoLieu($idTuan);
            // if($daVuotThoiGianBaoCao==1){
            //     return array('error'=>"Chốt số liệu thất bại, do vượt quá thời gian báo cáo."); // Trả về lỗi phương thức truyền số liệu
            // }

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
                $dataDmThoiGianBaoCao['thoi_gian_lay_so_lieu']=date('Y-m-d H:i:s');
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

            // Chốt số liệu các huyện
            // Tổng hợp số liệu của các tổ (huyện)
            $danhSachDonVis=DonVi::all()->toArray();
            $dsDonViCons=\Helper::layDonViConTheoMaCap($danhSachDonVis, $donVi['id'], 'HUYEN');
            foreach ($dsDonViCons as $key => $donViCon) {
                $maDonViCon='';
                if($baoCaoTheoMaDinhDanh==1){
                    $maDonViCon=$donViCon['ma_dinh_danh'];
                }else{
                    $maDonViCon=$donViCon['ma_don_vi'];
                }
                $this->maDonViCon=$maDonViCon;
                BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where('trang_thai','>',0)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->maDonViCon)->orWhere('ma_don_vi','=',$this->maDonViCon);
                })->update(['trang_thai'=>2]);
                $thoiGianBaoCaoDhsxkdTheoDonViCon=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where('trang_thai','>',0)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->maDonViCon)->orWhere('ma_don_vi','=',$this->maDonViCon);
                    })->get()->toArray();
                $idThoiGianBaoCaoDhsxkdDonViCon=0;
                if(count($thoiGianBaoCaoDhsxkdTheoDonViCon)>0){
                    $idThoiGianBaoCaoDhsxkdDonViCon=$thoiGianBaoCaoDhsxkdTheoDonViCon[0]['id'];
                }

                // Chốt số liệu ĐHSXKD đơn vị con
                BcDhsxkd::where('id_thoigian_baocao','=',$idThoiGianBaoCaoDhsxkdDonViCon)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->maDonViCon)->orWhere('ma_don_vi','=',$this->maDonViCon);
                })->update(['trang_thai'=>2]);
                // Chốt báo cáo tuần hiện tại đơn vị con
                BcTuanHienTai::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->maDonViCon)->orWhere('ma_don_vi','=',$this->maDonViCon);
                })->update(['trang_thai'=>2]);
                // Chốt kế hoạch tuần đơn vị con
                BcKeHoachTuan::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->maDonViCon)->orWhere('ma_don_vi','=',$this->maDonViCon);
                })->update(['trang_thai'=>2]);
                


            }

            $message=$donVi['ten_don_vi'].': đã duyệt và gửi báo cáo';
            $sendTelegram=\Helper::sendTelegramMessage($message);
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function guiThongBaoNhacNhoQuaTelegram(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];

            $checkQuyenGuiTbQuaTelegram=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'GUI_THONG_BAO_QUA_TELEGRAM'); 
            if(!$checkQuyenGuiTbQuaTelegram){
                return array('error'=>"Lỗi bạn không có quyền gửi thông báo qua Telegram.");
            }


            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];        
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            // Tổng hợp số liệu của các tổ (huyện)
            $danhSachDonVis=DonVi::all()->toArray();
            $dsDonViCons=\Helper::layDonViConTheoMaCap($danhSachDonVis, $donVi['id'], 'HUYEN');

            $dsDonViChuaBaoCao='';
            $dsDonViDaBaoCao='';
            $sttChuaGuiBaoCao=0;
            $sttDaGuiBaoCao=0;
            foreach ($dsDonViCons as $key => $donViCon) {  
                
                if($baoCaoTheoMaDinhDanh==1){
                    $this->ma=$donViCon['ma_dinh_danh'];
                }else{
                    $this->ma=$donViCon['ma_don_vi'];
                }
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->get()->toArray();

                if (count($thoiGianBaoCaoTheoDonVi)<=0) { // Chưa làm báo cáo
                    $sttChuaGuiBaoCao++;
                    $dsDonViChuaBaoCao.=$sttChuaGuiBaoCao.'/ '.$donViCon['ten_don_vi'].'
        ';
                }else{
                    if ($thoiGianBaoCaoTheoDonVi[0]['trang_thai']<1) { // Chưa làm báo cáo
                        $sttChuaGuiBaoCao++;
                        $dsDonViChuaBaoCao.=$sttChuaGuiBaoCao.'/ '.$donViCon['ten_don_vi'].'
        ';
                    }else{
                        $sttDaGuiBaoCao++;
                        $dsDonViDaBaoCao.=$sttDaGuiBaoCao.'/ '.$donViCon['ten_don_vi'].'
        ';
                    }
                }
            }
            
            $noiDungNhacNhoMacDinh=DmThamSoHeThong::getValueByName('BC_NOI_DUNG_NHAC_NHO_MAC_DINH');
            $noiDungNhacNho= $donVi['ten_don_vi'].' xin thông báo:
'.$noiDungNhacNhoMacDinh.'
        '.$dsDonViChuaBaoCao.'
- Danh sách đơn vị đã hoàn thành báo cáo gồm:
    '.$dsDonViDaBaoCao;

            // Gọi api gửi tin nhắn qua Telegram
            $r = Helper::sendTelegramMessage($noiDungNhacNho);
            if($r){
                return array('error'=>""); // Thành công
            }else{
                return array('error'=>"Gửi thông báo thất bại"); // Thành công
            }
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
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


    public function chenBaoCaoTuanHienTai(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id_tuan'];
            $idDichVu=null;
            $idBaoCaoTruoc=$data['id_bao_cao_truoc'];
            $baoCaoTruoc=BcTuanHienTai::find($idBaoCaoTruoc);

            $isGroupTruoc=0;
            $sapXepTruoc=0;
            if($baoCaoTruoc){
                $isGroupTruoc=$baoCaoTruoc->is_group-1;
                $sapXepTruoc=$baoCaoTruoc->sap_xep;
                if($isGroupTruoc<0){
                    $isGroupTruoc=0;
                }
                $idDichVu=$baoCaoTruoc->id_dich_vu;
            }

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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
                return  array('error'=>"Nội dung này đã tồn tại");
            }
            $dsBaoCaos=BcTuanHienTai::where('id_tuan','=',$data['id_tuan'])->where('sap_xep','>',$sapXepTruoc)->where('id','!=',$idBaoCaoTuan)->orderBy('sap_xep','asc')->get()->toArray();
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


    public function chenKeHoachTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id_tuan'];
            $idDichVu=null;
            $idBaoCaoTruoc=$data['id_bao_cao_truoc'];

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
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
                $idDichVu=$baoCaoTruoc->id_dich_vu;
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
            }else{
                return array("error"=>'Nội dung này đã tồn tại');
            }

            $dsBaoCaos=BcKeHoachTuan::where('id_tuan','=',$data['id_tuan'])->where('sap_xep','>',$sapXepTruoc)->where('id','!=',$idBaoCaoTuan)->orderBy('sap_xep','asc')->get()->toArray();
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
        $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'TTVT');
        if ($donVi['error']>0) {
            return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
        }
        $donVi=$donVi['data'];       
        
        $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
        $ma=''; // Mã đơn vị hay mã định danh
        $baoCaoTuanHienTais=array();

        // ĐHSXKD
        $idThoiGianBaoCaoDhsxkd=0; $baoCaoPakns=array();
        $thoiGianLaySoLieu='';
        if($baoCaoTheoMaDinhDanh==1){
            $ma=$donVi['ma_dinh_danh'];
            
        }else{ // Ngược lại báo cáo theo mã đơn vị
            $ma=$donVi['ma_don_vi'];                
        }// End DHSXKD

        $this->ma=$ma;

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
                $dataDmThoiGianBaoCao['thoi_gian_lay_so_lieu']=date('Y-m-d H:i:s');
                $dataDmThoiGianBaoCao['thoi_gian_chot_so_lieu']=null;
                $dataDmThoiGianBaoCao['ghi_chu']=null;
                $dataDmThoiGianBaoCao['trang_thai']=0;
                $bcDmThoiGianBaoCao=BcDmThoiGianBaoCao::create($dataDmThoiGianBaoCao);
                $idThoiGianBaoCaoDhsxkd=$bcDmThoiGianBaoCao->id;
                $thoiGianLaySoLieu=$bcDmThoiGianBaoCao->thoi_gian_lay_so_lieu;

            }else{ //Ngược lại thì chốt
                $idThoiGianBaoCaoDhsxkd=$thoiGianBaoCaoTheoDonVi[0]['id'];
                $thoiGianLaySoLieu=date('Y-m-d H:i:s');
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['thoi_gian_lay_so_lieu'=>$thoiGianLaySoLieu]);
            }
            $baoCaoPakns=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PAKN');
            // End DHSXKD



        $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
            $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
        })->get()->toArray();
        $trangThaiChotBaoCao=0; // Trạng thái chốt báo cáo đơn vị cha
        if($thoiGianBaoCaoTheoDonVi){
            $trangThaiChotBaoCao=$thoiGianBaoCaoTheoDonVi[0]['trang_thai'];
        }


        // Tổng hợp số liệu của các tổ (huyện)
        $danhSachDonVis=DonVi::all()->toArray();
        $dsDonViCons=\Helper::layDonViConTheoMaCap($danhSachDonVis, $donVi['id'], 'HUYEN');
        $tongHopBaoCaoCapHuyens=array();

        foreach ($dsDonViCons as $key => $donViCon) {                
            $maDonViCon='';
            $baoCaoCapHuyens=array();
            if($baoCaoTheoMaDinhDanh==1){
                $maDonViCon=$donViCon['ma_dinh_danh'];
            }else{
                $maDonViCon=$donViCon['ma_don_vi'];
            }
            $this->maDonViCon=$maDonViCon;
            $thoiGianBaoCaoDhsxkdTheoDonViCon=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->maDonViCon)->orWhere('ma_don_vi','=',$this->maDonViCon);
                })->get()->toArray();
            $idThoiGianBaoCaoDhsxkdDonViCon=0;
            $trangThaiBaoCaoDonViCon=0;
            $thoiGianChotSoLieuDonViCon='';
            if($thoiGianBaoCaoDhsxkdTheoDonViCon){
                $idThoiGianBaoCaoDhsxkdDonViCon=$thoiGianBaoCaoDhsxkdTheoDonViCon[0]['id'];
                $trangThaiBaoCaoDonViCon=$thoiGianBaoCaoDhsxkdTheoDonViCon[0]['trang_thai'];
                $thoiGianChotSoLieuDonViCon=$thoiGianBaoCaoDhsxkdTheoDonViCon[0]['thoi_gian_chot_so_lieu'];
            }
            $donViCon['trang_thai_chot_bao_cao']=$trangThaiBaoCaoDonViCon;
            $donViCon['thoi_gian_chot_so_lieu']=$thoiGianChotSoLieuDonViCon;
            $baoCaoCapHuyens['thong_tin_don_vi']=$donViCon;
            if($trangThaiBaoCaoDonViCon>0){
                // $baoCaoCapHuyenPhatTrienMois=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'PHAT_TRIEN_MOI');
                // $baoCaoCapHuyenXuLySuyHaos=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'XU_LY_SUY_HAO');

                $baoCaoCapHuyenPhatTrienMois=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'PHAT_TRIEN_MOI');
                $baoCaoCapHuyenXuLySuyHaos=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'XU_LY_SUY_HAO');
                $baoCaoCapHuyenGoiHomes=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'GOI_HOME');
                $baoCaoCapHuyenXuLyDungHans=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'XU_LU_DUNG_HAN');
                $baoCaoCapHuyenMLLs=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'MLL');
                $baoCaoCapHuyenB2As=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'B2A');
                $baoCaoCapHuyenDoHaiLongs=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'HAI_LONG');

                

                $baoCaoCapHuyenTuanHienTais=BcTuanHienTai::select('bc_tuan_hien_tai.id','bc_tuan_hien_tai.ma_don_vi','bc_tuan_hien_tai.ma_dinh_danh', 'bc_tuan_hien_tai.id_tuan', 'bc_tuan_hien_tai.id_user_bao_cao', 'bc_tuan_hien_tai.noi_dung', 'bc_tuan_hien_tai.thoi_gian_bao_cao', 'bc_tuan_hien_tai.ghi_chu', 'bc_tuan_hien_tai.is_group', 'bc_tuan_hien_tai.trang_thai', 'bc_tuan_hien_tai.sap_xep', 'bc_tuan_hien_tai.id_dich_vu')
                ->leftJoin('dich_vu','bc_tuan_hien_tai.id_dich_vu','=','dich_vu.id')
                ->where('bc_tuan_hien_tai.id_tuan','=',$idTuan)
                ->where(function($query) {
                    $query->where('bc_tuan_hien_tai.ma_dinh_danh','=',$this->maDonViCon)->orWhere('bc_tuan_hien_tai.ma_don_vi','=',$this->maDonViCon);
                })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_tuan_hien_tai.sap_xep','asc')
                ->get()->toArray();
                $baoCaoCapHuyenKeHoachTuans=BcKeHoachTuan::select('bc_ke_hoach_tuan.id','bc_ke_hoach_tuan.ma_don_vi','bc_ke_hoach_tuan.ma_dinh_danh', 'bc_ke_hoach_tuan.id_tuan', 'bc_ke_hoach_tuan.id_user_bao_cao', 'bc_ke_hoach_tuan.noi_dung', 'bc_ke_hoach_tuan.thoi_gian_bao_cao', 'bc_ke_hoach_tuan.ghi_chu', 'bc_ke_hoach_tuan.is_group', 'bc_ke_hoach_tuan.trang_thai', 'bc_ke_hoach_tuan.id_dich_vu', 'bc_ke_hoach_tuan.sap_xep')
                    ->leftJoin('dich_vu','bc_ke_hoach_tuan.id_dich_vu','=','dich_vu.id')
                    ->where('bc_ke_hoach_tuan.id_tuan','=',$idTuan)
                    ->where(function($query) {
                        $query->where('bc_ke_hoach_tuan.ma_dinh_danh','=',$this->maDonViCon)->orWhere('bc_ke_hoach_tuan.ma_don_vi','=',$this->maDonViCon);
                    })->orderBy('dich_vu.sap_xep','asc')->orderBy('bc_ke_hoach_tuan.sap_xep','asc')
                    ->get()->toArray();

                
                $baoCaoCapHuyens['ke_hoach_tuan']=$baoCaoCapHuyenKeHoachTuans;
                $baoCaoCapHuyens['tuan_hien_tai']=$baoCaoCapHuyenTuanHienTais;

                $baoCaoCapHuyens['phat_trien_moi']=$baoCaoCapHuyenPhatTrienMois;
                $baoCaoCapHuyens['xu_ly_suy_hao']=$baoCaoCapHuyenXuLySuyHaos;

                $baoCaoCapHuyens['goi_home']=$baoCaoCapHuyenGoiHomes;
                $baoCaoCapHuyens['xu_ly_dung_han']=$baoCaoCapHuyenXuLyDungHans;
                $baoCaoCapHuyens['mll']=$baoCaoCapHuyenMLLs;
                $baoCaoCapHuyens['b2a']=$baoCaoCapHuyenB2As;
                $baoCaoCapHuyens['hai_long']=$baoCaoCapHuyenDoHaiLongs;
                
            }
            $tongHopBaoCaoCapHuyens[]=$baoCaoCapHuyens;
        }
        
        return view('BaoCaoTuan::trung-tam-vien-thong.xuat-bao-cao', compact('baoCaoPakns', 'baoCaoTuanHienTais', 'baoCaoKeHoachTuans','error','idTuan', 'ma', 'dmTuan', 'donVi', 'userId', 'tongHopBaoCaoCapHuyens', 'trangThaiChotBaoCao')); // Trả dữ liệu ra view 
    }
}