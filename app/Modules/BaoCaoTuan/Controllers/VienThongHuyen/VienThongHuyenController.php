<?php
namespace App\Modules\BaoCaoTuan\Controllers\VienThongHuyen;

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
use App\BcMapDonViDhsxkd;
use App\BcDmChiSo;

class VienThongHuyenController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function baoCaoTuanVienThongHuyen(Request $request){
        $year=date('Y');
        $bcDmTuan=BcDmTuan::where('nam','=',$year)
        ->get()->toArray();
        return view('BaoCaoTuan::vien-thong-huyen.bao-cao-tuan-vien-thong-huyen',compact('bcDmTuan'));
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
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
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
            $baoCaos=BcTuanHienTai::where('id_tuan','=',$idTuan)
                ->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->orderBy('sap_xep','asc')
                ->get()->toArray();


            $view=view('BaoCaoTuan::vien-thong-huyen.danh-sach-bao-cao-tuan-hien-tai', compact('baoCaos','error','idTuan', 'ma'))->render(); // Trả dữ liệu ra view 
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

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
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


            $checkExits=BcTuanHienTai::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('noi_dung','=',$data['noi_dung'])->get()->toArray();
            if(count($checkExits)<=0){
                $dataBaoCaoTuan=array();
                $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                $dataBaoCaoTuan['noi_dung']=$data['noi_dung'];
                $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                $dataBaoCaoTuan['ghi_chu']=null;
                $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                $dataBaoCaoTuan['trang_thai']=0;
                $dataBaoCaoTuan['is_group']=0;
                $dataBaoCaoTuan['sap_xep']=0;
                $baoCaoTuan=BcTuanHienTai::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                $sapXep=$userId.$baoCaoTuan->sap_xep;
                $baoCaoTuan->sap_xep=$sapXep;
                $baoCaoTuan->save();
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

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
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
                BcTuanHienTai::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
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
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
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
            
            
            $baoCaos=BcKeHoachTuan::where('id_tuan','=',$idTuan)
                ->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->orderBy('sap_xep','asc')
                ->get()->toArray();
            $view=view('BaoCaoTuan::vien-thong-huyen.danh-sach-bao-cao-ke-hoach-tuan', compact('baoCaos','error','idTuan', 'ma'))->render(); // Trả dữ liệu ra view 
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

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
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


            $checkExits=BcKeHoachTuan::where('id_tuan','=',$data['id_tuan'])->where('id_user_bao_cao','=',$userId)->where('noi_dung','=',$data['noi_dung'])->get()->toArray();
            if(count($checkExits)<=0){
                $dataBaoCaoTuan=array();
                $dataBaoCaoTuan['id_tuan']=$data['id_tuan'];
                $dataBaoCaoTuan['id_user_bao_cao']=$userId;
                $dataBaoCaoTuan['noi_dung']=$data['noi_dung'];
                $dataBaoCaoTuan['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                $dataBaoCaoTuan['ma_don_vi']=$donVi['ma_don_vi'];
                $dataBaoCaoTuan['ghi_chu']=null;
                $dataBaoCaoTuan['thoi_gian_bao_cao']=date('Y-m-d H:i:s');
                $dataBaoCaoTuan['trang_thai']=0;
                $dataBaoCaoTuan['is_group']=0;
                $dataBaoCaoTuan['sap_xep']=0;
                $baoCaoTuan=BcKeHoachTuan::create($dataBaoCaoTuan); // Lưu dữ liệu vào DB
                $sapXep=$userId.$baoCaoTuan->sap_xep;
                $baoCaoTuan->sap_xep=$sapXep;
                $baoCaoTuan->save();
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
    public function danhSachBaoCaoDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi ".$donVi['message']); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];       
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma=''; // Mã đơn vị hay mã định danh
            $idThoiGianBaoCaoDhsxkd=0; $baoCaoPhatTrienMois=array(); $baoCaoXuLySuyHaos=array();
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
            $baoCaoPhatTrienMois=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PHAT_TRIEN_MOI');
            $baoCaoXuLySuyHaos=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'XU_LY_SUY_HAO');
            $baoCaoGoiHomes=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'GOI_HOME');
            $baoCaoXuLyDungHans=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'XU_LU_DUNG_HAN');
            $baoCaoMLLs=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'MLL');
            $baoCaoB2As=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'B2A');
            $baoCaoDoHaiLongs=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'HAI_LONG');

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

            $view=view('BaoCaoTuan::vien-thong-huyen.danh-sach-bao-cao-dhsxkd', compact('baoCaoPhatTrienMois','baoCaoXuLySuyHaos','error','idTuan', 'ma', 'thoiGianLaySoLieu', 'ngayLayDuLieuTuanTruoc', 'baoCaoGoiHomes', 'baoCaoXuLyDungHans', 'baoCaoMLLs', 'baoCaoB2As', 'baoCaoDoHaiLongs'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    
    protected $ma='';
    public function capNhatGhiChuBaoCaoDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $id=$data['id'];
            $ghiChu=$data['ghi_chu'];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
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
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
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
                $tuNgay = strtotime($ngayLayDuLieuTuanTruoc);
                $tuNgay = date('d/m/Y',$tuNgay);
                $denNgay = strtotime($thoiGianLaySoLieu);
                $denNgay = date('d/m/Y',$denNgay);
                $idDonVi=$donVi['id'];
                $donViLienThongDhsxkd=BcMapDonViDhsxkd::where('id_don_vi','=',$idDonVi)->where('state','=',1)->get()->toArray();
                if(count($donViLienThongDhsxkd)<=0){
                    return array('error'=>"Lỗi chưa map đơn vị liên thông");
                }
                $idDonViDhsxkd=$donViLienThongDhsxkd[0]['id_don_vi_dhsxkd'];

                // Giá trị tham số tự động thêm dm chỉ số đhsxkd đối với trường hợp chưa tồn tại chỉ số đó trong csdl; Bật tắt để cải thiện tốc độ truy vấn nhanh hơn
                $coTuDongThemDmChiSoDhsxkd=DmThamSoHeThong::getValueByName('BC_TU_DONG_THEM_DM_CHI_SO_DHSXKD');
                // Xóa số liệu cũ
                BcDhsxkd::where('id_thoigian_baocao','=',$idThoiGianBaoCaoDhsxkd)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                    })->delete();
                // Lấy số liệu phát triển mới
                $dsPhatTrienMois=BcDhsxkd::getPhatTrienMoiDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay);

                if($dsPhatTrienMois['errors']==0){
                    foreach ($dsPhatTrienMois['data'] as $key => $value) {
                        if($key!='donvi_id'){
                            if($coTuDongThemDmChiSoDhsxkd){
                                $checkDmChiSoDhsxkd=BcDmChiSo::where('chi_so','=',$key)->get()->toArray();
                                if(count($checkDmChiSoDhsxkd)<=0){
                                    // insert
                                    $dataDmChiSo=array();
                                    $dataDmChiSo['chi_so']=$key;
                                    $dataDmChiSo['mo_ta']=$key;
                                    $dataDmChiSo['parent_id']=null;

                                    $dmChiSoDhsxkd=BcDmChiSo::create($dataDmChiSo);
                                    $sapXep=$dmChiSoDhsxkd->id;
                                    $dmChiSoDhsxkd->sap_xep=$sapXep;
                                    $dmChiSoDhsxkd->save();
                                }
                            }
                                
                            $dataDhsxkd=array();
                            $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                            $dataDhsxkd['id_user_bao_cao']=$userId;
                            $dataDhsxkd['chi_so']=$key;
                            $dataDhsxkd['gia_tri']=$value;
                            $dataDhsxkd['is_group']=0;
                            $dataDhsxkd['ghi_chu']='';
                            $dataDhsxkd['loai_chi_so']='PHAT_TRIEN_MOI';
                            $dataDhsxkd['trang_thai']=0;
                            $dataDhsxkd['sap_xep']=0;
                            $bcDhsxkd=BcDhsxkd::create($dataDhsxkd);
                            $sapXep=$bcDhsxkd->id;
                            $bcDhsxkd->sap_xep=$sapXep;
                            $bcDhsxkd->save();
                        }
                            
                    }
                }


                // Xử lý suy hao
                $dsXuLySuyHaos=BcDhsxkd::getSoLieuXuLySuyHaoDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay);

                if($dsXuLySuyHaos['errors']==0){
                    foreach ($dsXuLySuyHaos['data'] as $key => $value) {
                        if($key!='donvi_id'){
                            $dataDhsxkd=array();
                            $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                            $dataDhsxkd['id_user_bao_cao']=$userId;
                            $dataDhsxkd['chi_so']=$value['ten_nv'];
                            $dataDhsxkd['suy_hao']=$value['tong_phieu'];
                            $dataDhsxkd['gia_tri']=$value['da_xuly'];
                            $dataDhsxkd['suy_hao_con_lai']=$value['suyhao_conlai'];
                            $dataDhsxkd['is_group']=0;
                            $dataDhsxkd['ghi_chu']='';
                            $dataDhsxkd['loai_chi_so']='XU_LY_SUY_HAO';
                            $dataDhsxkd['trang_thai']=0;
                            $dataDhsxkd['sap_xep']=0;
                            $bcDhsxkd=BcDhsxkd::create($dataDhsxkd);
                            $sapXep=$bcDhsxkd->id;
                            $bcDhsxkd->sap_xep=$sapXep;
                            $bcDhsxkd->save();
                        }
                            
                    }
                }


                // Lấy số liệu gói home
                $soLieuGoiHome=BcDhsxkd::getSoLieuGoiHomeDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay);

                if($soLieuGoiHome['errors']==0){
                    foreach ($soLieuGoiHome['data'] as $key => $value) {
                        if($key!='donvi_id'){
                            if($coTuDongThemDmChiSoDhsxkd){
                                $checkDmChiSoDhsxkd=BcDmChiSo::where('chi_so','=',$key)->get()->toArray();
                                if(count($checkDmChiSoDhsxkd)<=0){
                                    // insert
                                    $dataDmChiSo=array();
                                    $dataDmChiSo['chi_so']=$key;
                                    $dataDmChiSo['mo_ta']=$key;
                                    $dataDmChiSo['parent_id']=null;

                                    $dmChiSoDhsxkd=BcDmChiSo::create($dataDmChiSo);
                                    $sapXep=$dmChiSoDhsxkd->id;
                                    $dmChiSoDhsxkd->sap_xep=$sapXep;
                                    $dmChiSoDhsxkd->save();
                                }
                            }
                                
                            $dataDhsxkd=array();
                            $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                            $dataDhsxkd['id_user_bao_cao']=$userId;
                            $dataDhsxkd['chi_so']=$key;
                            $dataDhsxkd['gia_tri']=$value;
                            $dataDhsxkd['is_group']=0;
                            $dataDhsxkd['ghi_chu']='';
                            $dataDhsxkd['loai_chi_so']='GOI_HOME';
                            $dataDhsxkd['trang_thai']=0;
                            $dataDhsxkd['sap_xep']=0;
                            $bcDhsxkd=BcDhsxkd::create($dataDhsxkd);
                            $sapXep=$bcDhsxkd->id;
                            $bcDhsxkd->sap_xep=$sapXep;
                            $bcDhsxkd->save();
                        }
                            
                    }
                }


                // Lấy số liệu xử lý đúng hạn
                $soLieuXuLyDungHan=BcDhsxkd::getSoLieuXuLyDungHanDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay);

                if($soLieuXuLyDungHan['errors']==0){
                    foreach ($soLieuXuLyDungHan['data'] as $key => $value) {
                        if($key!='donvi_id'){
                            if($coTuDongThemDmChiSoDhsxkd){
                                $checkDmChiSoDhsxkd=BcDmChiSo::where('chi_so','=',$key)->get()->toArray();
                                if(count($checkDmChiSoDhsxkd)<=0){
                                    // insert
                                    $dataDmChiSo=array();
                                    $dataDmChiSo['chi_so']=$key;
                                    $dataDmChiSo['mo_ta']=$key;
                                    $dataDmChiSo['parent_id']=null;

                                    $dmChiSoDhsxkd=BcDmChiSo::create($dataDmChiSo);
                                    $sapXep=$dmChiSoDhsxkd->id;
                                    $dmChiSoDhsxkd->sap_xep=$sapXep;
                                    $dmChiSoDhsxkd->save();
                                }
                            }
                                
                            $dataDhsxkd=array();
                            $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                            $dataDhsxkd['id_user_bao_cao']=$userId;
                            $dataDhsxkd['chi_so']=$key;
                            $dataDhsxkd['gia_tri']=$value;
                            $dataDhsxkd['is_group']=0;
                            $dataDhsxkd['ghi_chu']='';
                            $dataDhsxkd['loai_chi_so']='XU_LU_DUNG_HAN';
                            $dataDhsxkd['trang_thai']=0;
                            $dataDhsxkd['sap_xep']=0;
                            $bcDhsxkd=BcDhsxkd::create($dataDhsxkd);
                            $sapXep=$bcDhsxkd->id;
                            $bcDhsxkd->sap_xep=$sapXep;
                            $bcDhsxkd->save();
                        }
                            
                    }
                }

                // Lấy số liệu Mất liên lạc
                $soLieuMatLienLacs=BcDhsxkd::getSoLieuMatLienLacDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay);

                if($soLieuMatLienLacs['errors']==0){
                    foreach ($soLieuMatLienLacs['data'] as $key => $value) {
                        if($key!='donvi_id'){
                            if($coTuDongThemDmChiSoDhsxkd){
                                $checkDmChiSoDhsxkd=BcDmChiSo::where('chi_so','=',$key)->get()->toArray();
                                if(count($checkDmChiSoDhsxkd)<=0){
                                    // insert
                                    $dataDmChiSo=array();
                                    $dataDmChiSo['chi_so']=$key;
                                    $dataDmChiSo['mo_ta']=$key;
                                    $dataDmChiSo['parent_id']=null;

                                    $dmChiSoDhsxkd=BcDmChiSo::create($dataDmChiSo);
                                    $sapXep=$dmChiSoDhsxkd->id;
                                    $dmChiSoDhsxkd->sap_xep=$sapXep;
                                    $dmChiSoDhsxkd->save();
                                }
                            }
                                
                            $dataDhsxkd=array();
                            $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                            $dataDhsxkd['id_user_bao_cao']=$userId;
                            $dataDhsxkd['chi_so']=$key;
                            $dataDhsxkd['gia_tri']=$value;
                            $dataDhsxkd['is_group']=0;
                            $dataDhsxkd['ghi_chu']='';
                            $dataDhsxkd['loai_chi_so']='MLL';
                            $dataDhsxkd['trang_thai']=0;
                            $dataDhsxkd['sap_xep']=0;
                            $bcDhsxkd=BcDhsxkd::create($dataDhsxkd);
                            $sapXep=$bcDhsxkd->id;
                            $bcDhsxkd->sap_xep=$sapXep;
                            $bcDhsxkd->save();
                        }
                            
                    }
                }


                // Lấy số liệu B2A
                $soLieuB2A=BcDhsxkd::getSoLieuB2ADhsxkd($idDonViDhsxkd, $tuNgay, $denNgay);

                if($soLieuB2A['errors']==0){
                    foreach ($soLieuB2A['data'] as $key => $value) {
                        if($key!='donvi_id'){
                            if($coTuDongThemDmChiSoDhsxkd){
                                $checkDmChiSoDhsxkd=BcDmChiSo::where('chi_so','=',$key)->get()->toArray();
                                if(count($checkDmChiSoDhsxkd)<=0){
                                    // insert
                                    $dataDmChiSo=array();
                                    $dataDmChiSo['chi_so']=$key;
                                    $dataDmChiSo['mo_ta']=$key;
                                    $dataDmChiSo['parent_id']=null;

                                    $dmChiSoDhsxkd=BcDmChiSo::create($dataDmChiSo);
                                    $sapXep=$dmChiSoDhsxkd->id;
                                    $dmChiSoDhsxkd->sap_xep=$sapXep;
                                    $dmChiSoDhsxkd->save();
                                }
                            }
                                
                            $dataDhsxkd=array();
                            $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                            $dataDhsxkd['id_user_bao_cao']=$userId;
                            $dataDhsxkd['chi_so']=$key;
                            $dataDhsxkd['gia_tri']=$value;
                            $dataDhsxkd['is_group']=0;
                            $dataDhsxkd['ghi_chu']='';
                            $dataDhsxkd['loai_chi_so']='B2A';
                            $dataDhsxkd['trang_thai']=0;
                            $dataDhsxkd['sap_xep']=0;
                            $bcDhsxkd=BcDhsxkd::create($dataDhsxkd);
                            $sapXep=$bcDhsxkd->id;
                            $bcDhsxkd->sap_xep=$sapXep;
                            $bcDhsxkd->save();
                        }
                            
                    }
                }


                // Lấy số liệu đánh giá độ hài lòng
                $soLieuDoHaiLong=BcDhsxkd::getSoLieuDoHaiLongDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay);

                if($soLieuDoHaiLong['errors']==0){
                    foreach ($soLieuDoHaiLong['data'] as $key => $value) {
                        if($key!='donvi_id'){
                            if($coTuDongThemDmChiSoDhsxkd){
                                $checkDmChiSoDhsxkd=BcDmChiSo::where('chi_so','=',$key)->get()->toArray();
                                if(count($checkDmChiSoDhsxkd)<=0){
                                    // insert
                                    $dataDmChiSo=array();
                                    $dataDmChiSo['chi_so']=$key;
                                    $dataDmChiSo['mo_ta']=$key;
                                    $dataDmChiSo['parent_id']=null;

                                    $dmChiSoDhsxkd=BcDmChiSo::create($dataDmChiSo);
                                    $sapXep=$dmChiSoDhsxkd->id;
                                    $dmChiSoDhsxkd->sap_xep=$sapXep;
                                    $dmChiSoDhsxkd->save();
                                }
                            }
                                
                            $dataDhsxkd=array();
                            $dataDhsxkd['ma_don_vi']=$donVi['ma_don_vi'];
                            $dataDhsxkd['ma_dinh_danh']=$donVi['ma_dinh_danh'];
                            $dataDhsxkd['id_thoigian_baocao']=$idThoiGianBaoCaoDhsxkd;
                            $dataDhsxkd['id_user_bao_cao']=$userId;
                            $dataDhsxkd['chi_so']=$key;
                            $dataDhsxkd['gia_tri']=$value;
                            $dataDhsxkd['is_group']=0;
                            $dataDhsxkd['ghi_chu']='';
                            $dataDhsxkd['loai_chi_so']='HAI_LONG';
                            $dataDhsxkd['trang_thai']=0;
                            $dataDhsxkd['sap_xep']=0;
                            $bcDhsxkd=BcDhsxkd::create($dataDhsxkd);
                            $sapXep=$bcDhsxkd->id;
                            $bcDhsxkd->sap_xep=$sapXep;
                            $bcDhsxkd->save();
                        }
                            
                    }
                }
            }else{ 

            }

            return array('error'=>""); // Trả về lỗi phương thức truyền số liệu
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }
    // End ĐHSXKD

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
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi ".$donVi['message']); // Trả về lỗi phương thức truyền số liệu
            }
            $donVi=$donVi['data'];       
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            $ma=''; // Mã đơn vị hay mã định danh
            $baoCaoTuanHienTais=array();

            // ĐHSXKD
            $idThoiGianBaoCaoDhsxkd=0; $baoCaoPhatTrienMois=array(); $baoCaoXuLySuyHaos=array();
            $thoiGianLaySoLieu='';
            if($baoCaoTheoMaDinhDanh==1){
                $ma=$donVi['ma_dinh_danh'];
                
            }else{ // Ngược lại báo cáo theo mã đơn vị
                $ma=$donVi['ma_don_vi'];
            }

            $this->ma=$ma;

            

            $baoCaoTuanHienTais=BcTuanHienTai::where('id_tuan','=',$idTuan)
                ->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->orderBy('sap_xep','asc')
                ->get()->toArray();

            $baoCaoKeHoachTuans=BcKeHoachTuan::where('id_tuan','=',$idTuan)
                ->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->orderBy('sap_xep','asc')
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
                $baoCaoPhatTrienMois=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PHAT_TRIEN_MOI');
                $baoCaoXuLySuyHaos=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'XU_LY_SUY_HAO');
                $baoCaoGoiHomes=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'GOI_HOME');
                $baoCaoXuLyDungHans=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'XU_LU_DUNG_HAN');
                $baoCaoMLLs=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'MLL');
                $baoCaoB2As=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'B2A');
                $baoCaoDoHaiLongs=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'HAI_LONG');
            // End DHSXKD

            $view=view('BaoCaoTuan::vien-thong-huyen.danh-sach-bao-cao-tong-hop', compact('baoCaoTuanHienTais', 'baoCaoKeHoachTuans','error','idTuan', 'ma', 'dmTuan', 'donVi', 'baoCaoPhatTrienMois','baoCaoXuLySuyHaos', 'thoiGianLaySoLieu', 'userId', 'baoCaoGoiHomes', 'baoCaoXuLyDungHans', 'baoCaoMLLs', 'baoCaoB2As', 'baoCaoDoHaiLongs'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function baoCaoTuanVienThongHuyenChotSoLieu(Request $request){
       if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];

            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'HUYEN');
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

            $this->ma=$ma;
            // Kiểm tra đã chốt số liệu chưa
            $daChoSoLieu=BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $ma);
            if($daChoSoLieu==1){
                return array('error'=>"Chốt số liệu thất bại, do báo cáo đã được gửi nên không thể chỉnh sửa."); // Trả về lỗi phương thức truyền số liệu
            }
            // Kiểm tra vượt thời gian gửi báo cáo
            /*$daVuotThoiGianBaoCao=BcDmThoiGianBaoCao::kiemTraVuotNgayChotSoLieu($idTuan);
            if($daVuotThoiGianBaoCao==1){
                return array('error'=>"Chốt số liệu thất bại, do vượt quá thời gian báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }*/

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
                $dataDmThoiGianBaoCao['trang_thai']=1;
                $bcDmThoiGianBaoCao=BcDmThoiGianBaoCao::create($dataDmThoiGianBaoCao);
                $idThoiGianBaoCaoDhsxkd=$bcDmThoiGianBaoCao->id;

            }else{ //Ngược lại thì chốt
                $idThoiGianBaoCaoDhsxkd=$thoiGianBaoCaoTheoDonVi[0]['id'];
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['trang_thai'=>1, 'thoi_gian_chot_so_lieu'=>date('Y-m-d H:i:s')]);
            }
            // Chốt báo cáo tuần hiện tại
            BcTuanHienTai::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['trang_thai'=>1]);
            // Chốt kế hoạch tuần
            BcKeHoachTuan::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['trang_thai'=>1]);
            // Chốt số liệu ĐHSXKD
            BcDhsxkd::where('id_thoigian_baocao','=',$idThoiGianBaoCaoDhsxkd)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->update(['trang_thai'=>1]);

            

            $message=$donVi['ten_don_vi'].': đã duyệt và gửi báo cáo';
            $sendTelegram=\Helper::sendTelegramMessage($message);
           
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }
    
    
}