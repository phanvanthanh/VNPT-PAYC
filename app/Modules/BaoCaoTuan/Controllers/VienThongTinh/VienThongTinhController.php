<?php
namespace App\Modules\BaoCaoTuan\Controllers\VienThongTinh;

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

class VienThongTinhController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function baoCaoTuan(Request $request){
        
        $year=date('Y');
        $bcDmTuan=BcDmTuan::where('nam','=',$year)
        ->get()->toArray();
        return view('BaoCaoTuan::vien-thong-tinh.bao-cao-tuan',compact('bcDmTuan'));
    }


    

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
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'VTT');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $vienThongTinh=$donVi['data'];       
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            // Lấy danh sách đơn vị phòng ban trực thuộc viễn thông tỉnh
            $phongBanTrungTams=DonVi::where('parent_id','=',$vienThongTinh['id'])->where(function($query) {
                $query->where('ma_cap','=','TTCNTT')->orWhere('ma_cap','=','TTDHTT')->orWhere('ma_cap','=','TTKD')->orWhere('ma_cap','=','PHONG');
            })->get()->toArray();
            $dataPhongBanTrungTams=array();
            foreach ($phongBanTrungTams as $key => $phongBanTrungTam) {
                $dataPhongBanTrungTams[]=VienThongTinhController::layDuLieuBaoCaoTrungTamTrucThuoc($idTuan, $phongBanTrungTam, $baoCaoTheoMaDinhDanh);
            }


            // Lấy đơn vị TTVT
            $ttvts=DonVi::where('ma_cap','=','TTVT')->where('parent_id','=',$vienThongTinh['id'])->get()->toArray();
            $dataTtvts=array();
            foreach ($ttvts as $key => $ttvt) {
                $dataTtvts[]=VienThongTinhController::layDuLieuBaoCaoCapHuyen($idTuan, $ttvt, $baoCaoTheoMaDinhDanh);
            }
            

            $view=view('BaoCaoTuan::vien-thong-tinh.danh-sach-bao-cao-tong-hop', compact('error','idTuan', 'dmTuan', 'userId', 'dataTtvts', 'dataPhongBanTrungTams'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }


    public function layDuLieuBaoCaoCapHuyen($idTuan, $donVi, $baoCaoTheoMaDinhDanh){
        $trungTam=VienThongTinhController::layDuLieuBaoCaoTrungTamTrucThuoc($idTuan, $donVi, $baoCaoTheoMaDinhDanh);


        // Tổng hợp số liệu của các tổ (huyện)
        $danhSachDonVis=DonVi::all()->toArray();
        $dsDonViCons=DonVi::where('parent_id','=',$donVi['id'])->where('ma_cap','=','HUYEN')->get()->toArray();
        //$helper=new Helper();
        //$dsDonViCons=$helper::layDonViConTheoMaCap($danhSachDonVis, $donVi['id'], 'HUYEN');
        $tongHopBaoCaoCapHuyens=array();

        foreach ($dsDonViCons as $key => $donViCon) {                
            $maDonViCon='';
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
            if($thoiGianBaoCaoDhsxkdTheoDonViCon){
                $idThoiGianBaoCaoDhsxkdDonViCon=$thoiGianBaoCaoDhsxkdTheoDonViCon[0]['id'];
                $trangThaiBaoCaoDonViCon=$thoiGianBaoCaoDhsxkdTheoDonViCon[0]['trang_thai'];
            }
            $donViCon['trang_thai_chot_bao_cao']=$trangThaiBaoCaoDonViCon;
            $baoCaoCapHuyens['thong_tin_don_vi']=$donViCon;
            if($trangThaiBaoCaoDonViCon>0){
                $baoCaoCapHuyenPhatTrienMois=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'PHAT_TRIEN_MOI');
                $baoCaoCapHuyenXuLySuyHaos=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($maDonViCon, $idThoiGianBaoCaoDhsxkdDonViCon, 'XU_LY_SUY_HAO');

                
                $baoCaoCapHuyenKeHoachTuans=BcKeHoachTuan::where('id_tuan','=',$idTuan)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->maDonViCon)->orWhere('ma_don_vi','=',$this->maDonViCon);
                    })->get()->toArray();
                $baoCaoCapHuyenTuanHienTais=BcTuanHienTai::where('id_tuan','=',$idTuan)->where(function($query) {
                        $query->where('ma_dinh_danh','=',$this->maDonViCon)->orWhere('ma_don_vi','=',$this->maDonViCon);
                    })->get()->toArray();

                $baoCaoCapHuyens['phat_trien_moi']=$baoCaoCapHuyenPhatTrienMois;
                $baoCaoCapHuyens['xu_ly_suy_hao']=$baoCaoCapHuyenXuLySuyHaos;
                $baoCaoCapHuyens['ke_hoach_tuan']=$baoCaoCapHuyenKeHoachTuans;
                $baoCaoCapHuyens['tuan_hien_tai']=$baoCaoCapHuyenTuanHienTais;
                
            }
            $tongHopBaoCaoCapHuyens[]=$baoCaoCapHuyens;
        }

        return array(
            'donVi'=>$trungTam['donVi'],
            'baoCaoPakns'=>$trungTam['baoCaoPakns'], 
            'baoCaoTuanHienTais'=>$trungTam['baoCaoTuanHienTais'], 
            'baoCaoKeHoachTuans'=>$trungTam['baoCaoKeHoachTuans'], 
            'tongHopBaoCaoCapHuyens'=>$tongHopBaoCaoCapHuyens,
            'trangThaiChotBaoCao'=>$trungTam['trangThaiChotBaoCao']
        );

    }



    public function layDuLieuBaoCaoTrungTamTrucThuoc($idTuan, $donVi, $baoCaoTheoMaDinhDanh){
        $ma=''; // Mã đơn vị hay mã định danh
        $baoCaoTuanHienTais=array();
        $baoCaoKeHoachTuans=array();        
        // ĐHSXKD
        $idThoiGianBaoCaoDhsxkd=0; $baoCaoPakns=array();
        $thoiGianLaySoLieu='';
        if($baoCaoTheoMaDinhDanh==1){
            $ma=$donVi['ma_dinh_danh'];

            $baoCaoTuanHienTais=BcTuanHienTai::where('id_tuan','=',$idTuan)
            ->where('ma_dinh_danh','=',$donVi['ma_dinh_danh'])
            ->get()->toArray();

            $baoCaoKeHoachTuans=BcKeHoachTuan::where('id_tuan','=',$idTuan)
            ->where('ma_dinh_danh','=',$donVi['ma_dinh_danh'])
            ->get()->toArray();

            // ĐHSXKD
            $idThoiGianBaoCaoDhsxkd=0;
            $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('ma_dinh_danh','=',$ma)->where('id_tuan','=',$idTuan)->get()->toArray();
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
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('ma_dinh_danh','=',$ma)->where('id_tuan','=',$idTuan)->update(['thoi_gian_lay_so_lieu'=>$thoiGianLaySoLieu]);
            }
            $baoCaoPakns=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PAKN');
            // End DHSXKD

            
        }else{ // Ngược lại báo cáo theo mã đơn vị
            $ma=$donVi['ma_don_vi'];


            $baoCaoTuanHienTais=BcTuanHienTai::where('id_tuan','=',$idTuan)
            ->where('ma_don_vi','=',$donVi['ma_don_vi'])
            ->get()->toArray();

            $baoCaoKeHoachTuans=BcKeHoachTuan::where('id_tuan','=',$idTuan)
            ->where('ma_don_vi','=',$donVi['ma_don_vi'])
            ->get()->toArray();

            // ĐHSXKD
            $idThoiGianBaoCaoDhsxkd=0;
            $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('ma_don_vi','=',$ma)->where('id_tuan','=',$idTuan)->get()->toArray();
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
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('ma_don_vi','=',$ma)->where('id_tuan','=',$idTuan)->update(['thoi_gian_lay_so_lieu'=>$thoiGianLaySoLieu]);
            }
            $baoCaoPakns=BcDhsxkd::layDanhSachBcDhsxkdTheoLoai($ma, $idThoiGianBaoCaoDhsxkd, 'PAKN');
            
        }// End DHSXKD

        $this->ma=$ma;
        $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
            $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
        })->get()->toArray();
        $trangThaiChotBaoCao=0; // Trạng thái chốt báo cáo đơn vị cha
        if($thoiGianBaoCaoTheoDonVi){
            $trangThaiChotBaoCao=$thoiGianBaoCaoTheoDonVi[0]['trang_thai'];
        }

        return array(
            'donVi'=>$donVi,
            'baoCaoPakns'=>$baoCaoPakns, 
            'baoCaoTuanHienTais'=>$baoCaoTuanHienTais, 
            'baoCaoKeHoachTuans'=>$baoCaoKeHoachTuans,
            'trangThaiChotBaoCao'=>$trangThaiChotBaoCao
        );
    }


    public function guiThongBaoNhacNhoQuaTelegram(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $checkQuyenGuiTbQuaTelegram=\Helper::kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, 'GUI_THONG_BAO_QUA_TELEGRAM'); 
            if(!$checkQuyenGuiTbQuaTelegram){
                return array('error'=>"Lỗi bạn không có quyền gửi thông báo qua Telegram.");
            }
            
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idTuan=$data['id'];
            $dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
            if(count($dmTuan)<=0){
                return array('error'=>"Lỗi không tìm thấy thời gian báo cáo");
            }
            $dmTuan=$dmTuan[0];
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'VTT');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $vienThongTinh=$donVi['data'];       
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            // Lấy danh sách đơn vị phòng ban trực thuộc viễn thông tỉnh
            $phongBanTrungTams=DonVi::where('parent_id','=',$vienThongTinh['id'])->where(function($query) {
                $query->where('ma_cap','=','TTCNTT')->orWhere('ma_cap','=','TTDHTT')->orWhere('ma_cap','=','TTKD')->orWhere('ma_cap','=','PHONG');
            })->get()->toArray();

            $dsDonViChuaBaoCao='';
            $sttChuaGuiBaoCao=0;
            foreach ($phongBanTrungTams as $key => $phongBanTrungTam) {
                
                if($baoCaoTheoMaDinhDanh==1){
                    $this->ma=$phongBanTrungTam['ma_dinh_danh'];
                }else{
                    $this->ma=$phongBanTrungTam['ma_don_vi'];
                }
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->get()->toArray();

                if (count($thoiGianBaoCaoTheoDonVi)<=0) { // Chưa làm báo cáo
                    $sttChuaGuiBaoCao++;
                    $dsDonViChuaBaoCao.=$sttChuaGuiBaoCao.'/ '.$phongBanTrungTam['ten_don_vi'].'
        ';
                }else{
                    if ($thoiGianBaoCaoTheoDonVi[0]['trang_thai']!=2) { // Chưa làm báo cáo
                        $sttChuaGuiBaoCao++;
                        $dsDonViChuaBaoCao.=$sttChuaGuiBaoCao.'/ '.$phongBanTrungTam['ten_don_vi'].'
        ';
                    }
                }
            }


            // Lấy đơn vị TTVT
            $ttvts=DonVi::where('ma_cap','=','TTVT')->where('parent_id','=',$vienThongTinh['id'])->get()->toArray();
            $dataTtvts=array();
            foreach ($ttvts as $key => $ttvt) {
                
                if($baoCaoTheoMaDinhDanh==1){
                    $this->ma=$ttvt['ma_dinh_danh'];
                }else{
                    $this->ma=$ttvt['ma_don_vi'];
                }
                $thoiGianBaoCaoTheoDonVi=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
                    $query->where('ma_dinh_danh','=',$this->ma)->orWhere('ma_don_vi','=',$this->ma);
                })->get()->toArray();

                if (count($thoiGianBaoCaoTheoDonVi)<=0) { // Chưa làm báo cáo
                    $sttChuaGuiBaoCao++;
                    $dsDonViChuaBaoCao.=$sttChuaGuiBaoCao.'/ '.$ttvt['ten_don_vi'].'
        ';
                }else{
                    if ($thoiGianBaoCaoTheoDonVi[0]['trang_thai']!=2) { // Chưa làm báo cáo
                        $sttChuaGuiBaoCao++;
                        $dsDonViChuaBaoCao.=$sttChuaGuiBaoCao.'/ '.$ttvt['ten_don_vi'].'
        ';
                    }
                }
            }
            $noiDungNhacNhoMacDinh=DmThamSoHeThong::getValueByName('BC_NOI_DUNG_NHAC_NHO_MAC_DINH');
            $noiDungNhacNho=$vienThongTinh['ten_don_vi'].' xin thông báo:
'.$noiDungNhacNhoMacDinh.'
        '.$dsDonViChuaBaoCao;       
            
            $r = Helper::sendTelegramMessage($noiDungNhacNho);
            if($r){
                return array('error'=>""); // Thành công
            }else{
                return array('error'=>"Gửi thông báo thất bại"); // Thành công
            }
                
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }


    

    


    public function xemBaoCaoTuanToanTinh(Request $request){
        
        $year=date('Y');
        $bcDmTuan=BcDmTuan::where('nam','=',$year)
        ->get()->toArray();
        return view('BaoCaoTuan::vien-thong-tinh.xem-bao-cao-tuan-toan-tinh',compact('bcDmTuan'));
    }

    public function xemDanhSachBaoCaoTongHopToanTinh(Request $request){
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
            $donVi=DonVi::getDonViCapTrenTheoTaiKhoan($userId, 'VTT');
            if ($donVi['error']>0) {
                return array('error'=>"Lỗi Lỗi tài khoản không có quyền báo cáo."); // Trả về lỗi phương thức truyền số liệu
            }
            $vienThongTinh=$donVi['data'];       
            
            $baoCaoTheoMaDinhDanh=DmThamSoHeThong::getValueByName('BC_BAO_CAO_THEO_MA_DINH_DANH');
            // Lấy danh sách đơn vị phòng ban trực thuộc viễn thông tỉnh
            $phongBanTrungTams=DonVi::where('parent_id','=',$vienThongTinh['id'])->where(function($query) {
                $query->where('ma_cap','=','TTCNTT')->orWhere('ma_cap','=','TTDHTT')->orWhere('ma_cap','=','TTKD')->orWhere('ma_cap','=','PHONG');
            })->get()->toArray();
            $dataPhongBanTrungTams=array();
            foreach ($phongBanTrungTams as $key => $phongBanTrungTam) {
                $dataPhongBanTrungTams[]=VienThongTinhController::layDuLieuBaoCaoTrungTamTrucThuoc($idTuan, $phongBanTrungTam, $baoCaoTheoMaDinhDanh);
            }


            // Lấy đơn vị TTVT
            $ttvts=DonVi::where('ma_cap','=','TTVT')->where('parent_id','=',$vienThongTinh['id'])->get()->toArray();
            $dataTtvts=array();
            foreach ($ttvts as $key => $ttvt) {
                $dataTtvts[]=VienThongTinhController::layDuLieuBaoCaoCapHuyen($idTuan, $ttvt, $baoCaoTheoMaDinhDanh);
            }
            

            $view=view('BaoCaoTuan::vien-thong-tinh.xem-danh-sach-bao-cao-tong-hop-toan-tinh', compact('error','idTuan', 'dmTuan', 'userId', 'dataTtvts', 'dataPhongBanTrungTams'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }


    public function huyChotBaoCaoTuan(Request $request){
        
        $year=date('Y');
        $bcDmTuan=BcDmTuan::where('nam','=',$year)
        ->get()->toArray();
        return view('BaoCaoTuan::vien-thong-tinh.huy-chot-bao-cao-tuan',compact('bcDmTuan'));
    }

    public function danhSachHuyChotBaoCaoTuan(Request $request){
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

            $dsChotSoLieu=BcDmThoiGianBaoCao::select('bc_dm_thoi_gian_bao_cao.id', 'bc_dm_thoi_gian_bao_cao.ma_don_vi', 'bc_dm_thoi_gian_bao_cao.ma_dinh_danh', 'bc_dm_thoi_gian_bao_cao.thoi_gian_lay_so_lieu', 'bc_dm_thoi_gian_bao_cao.thoi_gian_chot_so_lieu', 'bc_dm_thoi_gian_bao_cao.trang_thai', 'bc_dm_tuan.tuan', 'bc_dm_tuan.nam', 'bc_dm_tuan.tu_ngay', 'bc_dm_tuan.den_ngay')
                ->where('bc_dm_thoi_gian_bao_cao.id_tuan','=',$idTuan)
                ->leftJoin('bc_dm_tuan','bc_dm_thoi_gian_bao_cao.id_tuan','=','bc_dm_tuan.id')
                ->get()->toArray();
            

            $view=view('BaoCaoTuan::vien-thong-tinh.danh-sach-huy-chot-bao-cao-tuan', compact('error','idTuan', 'dmTuan', 'userId', 'dsChotSoLieu'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    
    public function btnHuyChotBaoCaoTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=0; $error=''; // Khai báo biến
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $idThoiGianBaoCao=$data['id'];
            $thoiGianBaoCao=BcDmThoiGianBaoCao::find($idThoiGianBaoCao);
            if($thoiGianBaoCao){
                $thoiGianBaoCao->trang_thai=0;
                $thoiGianBaoCao->thoi_gian_chot_so_lieu=null;
                $thoiGianBaoCao->save();
            }else{
                return array('error'=>"Không tìm thấy đơn vị cần hủy chốt số liệu.");
            }
            return array('error'=>"");
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }
    
    
}