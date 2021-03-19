<?php
namespace App\Modules\Payc\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use App\DonVi;
use App\Payc;
use App\AdminRole;
use App\PaycXuLy;
use App\UsersDichVu;
use App\PaycTrangThaiXuLy;
use App\DmQuanHuyen;
use App\DmPhuongXa;
use App\UsersDonVi;
use App\DmThamSoHeThong;
use App\DichVu;
use App\PaycCanBoNhan;
use Request as RequestAjax;


class PaycController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }
    private $pathFile='public/file/payc';

    public function payc(Request $request){
        $idUser=1;
        if(Auth::id()){
            $idUser=Auth::id();
        }
        $dmQuanHuyens=DmQuanHuyen::all()->toArray();
        $dmPhuongXas=DmPhuongXa::all()->toArray();
        $donViMacDinh=UsersDonVi::getDonViMacDinh($idUser);
        $dichVus=DichVu::all()->toArray();
        return view('Payc::payc', compact('dichVus', 'dmQuanHuyens','dmPhuongXas','donViMacDinh'));
    }

    public function danhSachPaycCuaToi(Request $request){
        $userId=1;
        if(Auth::id()){
            $userId=Auth::id();
        }
        $error=''; // Khai báo biến
        $paycs=array();
         // Thực hiện lưu thông tin
        $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','LD_DANH_GIA')->get()->toArray();
        $idLDDanhGia=0;
        if($trangThai){
            $idLDDanhGia=$trangThai[0]['id'];
        }
        

        $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','KH_DANH_GIA')->get()->toArray();
        $idKHDanhGia=0;
        if($trangThai){
            $idKHDanhGia=$trangThai[0]['id'];
        }

        if($userId){
            $paycs=Payc::getDanhSachPaycCuaToi($userId);
            return view('Payc::danh-sach-payc-cua-toi', compact('paycs','idKHDanhGia','idLDDanhGia','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-cua-toi', compact('paycs','idKHDanhGia','idLDDanhGia','error'));

        
    }    


    public function themPayc(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $userId=Auth::id();
            if(!$userId){ // Nếu chưa đăng nhập thì nhận chế độ ẩn danh
                $userId=1;
            }
            // hoặc nếu bật chế độ ẩn danh cũng tiếp nhận ẩn danh luôn
            if(isset($data['is_an_danh']) && $data['is_an_danh']==1){
                $userId=1;
            }
            
            $data['id_user_tao']=$userId;
            if ($request->hasFile('file_payc')) {
                $data['file_payc']=\Helper::getAndStoreFile($request->file('file_payc'));
            }
            $data['han_xu_ly_mong_muon']=\Helper::toDatePayc($data['ngay'].' '.$data['gio'].':00');
            $data['id_users']=$userId;
            $data['so_phieu']=Payc::taoSoPhieu();
            $payc=Payc::create($data); // Lưu dữ liệu vào DB
            $idPayc=$payc->id;

            // Tạo lịch sử xử lý là tạo yêu cầu
            $trangThaiTiepNhan=PaycTrangThaiXuLy::where('ma_trang_thai','=','TAO_MOI')->get()->toArray();
            if(count($trangThaiTiepNhan)<1){
                return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
            }
            
            $idXuLyTiepNhan=$trangThaiTiepNhan[0]['id'];
            
            $canBoXuLyYeuCau['id_payc']=$idPayc;
            $canBoXuLyYeuCau['id_user_xu_ly']=$userId;
            $canBoXuLyYeuCau['id_xu_ly']=$idXuLyTiepNhan;
            $canBoXuLyYeuCau['noi_dung_xu_ly']='';
            $canBoXuLyYeuCau['file_xu_ly']='';
            $xuLyTiepNhan=PaycXuLy::create($canBoXuLyYeuCau); // lưu log tạo pakn

            $idXuLyYeuCau=$xuLyTiepNhan->id;
            $idDichVu=$data['id_dich_vu'];
            $maNhomDichVu=DichVu::getMaNhomDichVuByIdDichVu($idDichVu);
            $nhomChucVuNhanPakn=DmThamSoHeThong::getValueByName('MA_NHOM_CHUC_VU_NHAN_PAKN');
            $dsCanBoNhans=array();
            if($maNhomDichVu=='DV_VT'){ // Nếu nhóm dịch vụ viễn thông thì cấp xã hoặc huyện tiếp nhận
                // Lấy danh sách cán bộ
                $capMacDinh=DmThamSoHeThong::getValueByName('CAP_TIEP_NHAN_MAC_DINH');
                $maPhuongXa=$data['ma_phuong_xa'];
                // Từ mã phường xã suy ra mã quận huyện
                $phuongXa=DmPhuongXa::where('ma_phuong_xa','=',$maPhuongXa)->get()->toArray();
                $maHuyen=null;
                if($phuongXa){
                    $maHuyen=$phuongXa[0]['ma_quan_huyen'];
                }
                if($capMacDinh=='XA'){
                    $dsCanBoNhans=DonVi::layCanBoThuocCapXaTheoMaPhuongXaVaMaNhomChucVu($maPhuongXa,$nhomChucVuNhanPakn, $idDichVu);
                }else{ // Ngược lại là cấp huyện
                    $dsCanBoNhans=DonVi::layCanBoThuocCapHuyenTheoMaHuyenVaMaNhomChucVu($maHuyen,$nhomChucVuNhanPakn, $idDichVu);
                }
            } 
            else{ // Có thể mở rộng chỗ này: nếu nhóm dịch vụ công nghệ thông tin thì cấp trung tâm tiếp nhận
                
            }
            // Nếu nhóm chức vụ nhận là LANH_DAO hoặc XU_LY thì ghi thêm log chuyển lãnh đạo hoặc chuyển xử lý
            if($nhomChucVuNhanPakn=='LANH_DAO'){
                // Tạo lịch sử xử lý là chuyển lãnh đạo
                $trangThaiTiepNhan=PaycTrangThaiXuLy::where('ma_trang_thai','=','CHUYEN_LANH_DAO')->get()->toArray();
                if(count($trangThaiTiepNhan)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                
                $idXuLyTiepNhan=$trangThaiTiepNhan[0]['id'];
                
                $canBoXuLyYeuCau['id_payc']=$idPayc;
                $canBoXuLyYeuCau['id_user_xu_ly']=$userId;
                $canBoXuLyYeuCau['id_xu_ly']=$idXuLyTiepNhan;
                $canBoXuLyYeuCau['noi_dung_xu_ly']='';
                $canBoXuLyYeuCau['file_xu_ly']='';
                $xuLyTiepNhan=PaycXuLy::create($canBoXuLyYeuCau);
                $idXuLyYeuCau=$xuLyTiepNhan->id;
            }elseif ($nhomChucVuNhanPakn=='XU_LY') {
                // Tạo lịch sử xử lý là chuyển bộ phận xử lý
                $trangThaiTiepNhan=PaycTrangThaiXuLy::where('ma_trang_thai','=','CHUYEN_XU_LY')->get()->toArray();
                if(count($trangThaiTiepNhan)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                
                $idXuLyTiepNhan=$trangThaiTiepNhan[0]['id'];
                
                $canBoXuLyYeuCau['id_payc']=$idPayc;
                $canBoXuLyYeuCau['id_user_xu_ly']=$userId;
                $canBoXuLyYeuCau['id_xu_ly']=$idXuLyTiepNhan;
                $canBoXuLyYeuCau['noi_dung_xu_ly']='';
                $canBoXuLyYeuCau['file_xu_ly']='';
                $xuLyTiepNhan=PaycXuLy::create($canBoXuLyYeuCau);
                $idXuLyYeuCau=$xuLyTiepNhan->id;
            }
            foreach ($dsCanBoNhans as $key => $canBoNhan) {
                $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                $paknCanBoNhanData['id_user_nhan']=$canBoNhan['id'];
                $paknCanBoNhanData['trang_thai']=0;
                $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
            }

            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function danhSachPaycChoTiepNhan(Request $request){
        $userId=Auth::id();
        if(!$userId){
            return array("error"=>'Chưa đăng nhập vào hệ thống!');
        }
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycChoTiepNhan($userId);
            return view('Payc::danh-sach-payc-cho-tiep-nhan', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-cho-tiep-nhan', compact('paycs','error'));
    }  

    public function frmTiepNhanVaChuyenXuLy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsId=explode(';', $dataForm['id']);
                if(count($dsId)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    $view=view('Payc::frm-tiep-nhan-va-chuyen-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                    return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsId[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                array_pop($dsId); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null
                foreach ($dsId as $key => $id) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$id)->get()->toArray();
                    if(!is_numeric($id) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        $error="Không được chọn nhiều dịch vụ khác nhau!";
                        $view=view('Payc::frm-tiep-nhan-va-chuyen-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                        return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                    }
                }
                // Điều kiện đúng thực hiện render form
                $data=UsersDichVu::layDanhSachCanBoXuLy($userId);
                $error='';
                $view=view('Payc::frm-tiep-nhan-va-chuyen-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau

            }
            $error='Vui lòng chọn PAYC cần chuyển xử lý!';
            $view=view('Payc::frm-tiep-nhan-va-chuyen-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function tiepNhanVaChuyenXuLy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            if(isset($data['ds_id_payc_tiep_nhan_va_chuyen_xu_ly'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_tiep_nhan_va_chuyen_xu_ly']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsIdPayc[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Kiểm tra tính hợp lệ của các payc
                foreach ($dsIdPayc as $key => $idPayc) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$idPayc)->get()->toArray();
                    if(!is_numeric($idPayc) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        return array("error"=>"Không được chọn nhiều dịch vụ khác nhau!");
                    }
                }
                // Thực hiện lưu thông tin
                $trangThaiTiepNhan=PaycTrangThaiXuLy::where('ma_trang_thai','=','TIEP_NHAN')->get()->toArray();
                $trangThaiChuyenXuLy=PaycTrangThaiXuLy::where('ma_trang_thai','=','CHUYEN_XU_LY')->get()->toArray();
                if(count($trangThaiTiepNhan)<1 || count($trangThaiChuyenXuLy)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLyTiepNhan=$trangThaiTiepNhan[0]['id'];
                $idXuLyChuyenXuLy=$trangThaiChuyenXuLy[0]['id'];
                $canBoXuLyYeuCau=array();
                if ($request->hasFile('file_xu_ly')) {
                    $canBoXuLyYeuCau['file_xu_ly']=\Helper::getAndStoreFile($request->file('file_xu_ly'));
                }
                foreach ($dsIdPayc as $key => $idPayc) {
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                    $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                    $canBoXuLyYeuCau['ds_id_user_nhan']=$data['ds_id_user_tiep_nhan_va_chuyen_xu_ly'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLyChuyenXuLy;
                    $xuLyTiepNhan=PaycXuLy::create($canBoXuLyYeuCau);
                    $idXuLyYeuCau=$xuLyTiepNhan->id;

                    if($data['ds_id_user_tiep_nhan_va_chuyen_xu_ly']){
                        $dsCanBoNhans=explode(';', $data['ds_id_user_tiep_nhan_va_chuyen_xu_ly']);
                        array_pop($dsCanBoNhans);
                        foreach ($dsCanBoNhans as $key => $canBoNhan) {
                            $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                            $paknCanBoNhanData['id_user_nhan']=$canBoNhan;
                            $paknCanBoNhanData['trang_thai']=0;
                            $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                        }
                    }else{
                        $dsDonVis=UsersDichVu::layDanhSachCanBoXuLy($userId);
                        foreach ($dsDonVis as $key => $donVi) {
                            foreach ($donVi['ds_can_bo'] as $key => $canBoNhan) {
                                $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                                $paknCanBoNhanData['id_user_nhan']=$canBoNhan['id'];
                                $paknCanBoNhanData['trang_thai']=0;
                                $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                            }
                                
                        }
                    }
                        
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function danhSachPaycChoXuLy(Request $request){
        $userId=Auth::id();
        if(!$userId){
            return array("error"=>'Chưa đăng nhập vào hệ thống!');
        }
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycChoXuLy($userId);
            return view('Payc::danh-sach-payc-cho-xu-ly', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-cho-xu-ly', compact('paycs','error'));
    }  

    public function frmXuLy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsId=explode(';', $dataForm['id']);
                if(count($dsId)<2){
                    $error='Vui lòng chọn PAYC cần xử lý!';
                    $view=view('Payc::frm-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                    return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsId[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                array_pop($dsId); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null
                foreach ($dsId as $key => $id) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$id)->get()->toArray();
                    if(!is_numeric($id) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        $error="Không được chọn nhiều dịch vụ khác nhau!";
                        $view=view('Payc::frm-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                        return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                    }
                }
                // Điều kiện đúng thực hiện render form
                $data=UsersDichVu::layDanhSachCanBoXuLy($userId);
                $error='';
                $view=view('Payc::frm-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau

            }
            $error='Vui lòng chọn PAYC cần chuyển xử lý!';
            $view=view('Payc::frm-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function xuLy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            if(isset($data['ds_id_payc_xu_ly'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_xu_ly']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsIdPayc[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Kiểm tra tính hợp lệ của các payc
                foreach ($dsIdPayc as $key => $idPayc) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$idPayc)->get()->toArray();
                    if(!is_numeric($idPayc) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        return array("error"=>"Không được chọn nhiều dịch vụ khác nhau!");
                    }
                }
                 // Thực hiện lưu thông tin
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','XU_LY')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                $canBoXuLyYeuCau=array();
                if ($request->hasFile('file_xu_ly')) {
                    $canBoXuLyYeuCau['file_xu_ly']=\Helper::getAndStoreFile($request->file('file_xu_ly'));
                }
                foreach ($dsIdPayc as $key => $idPayc) {
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                    $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);


                    $idXuLyYeuCau=$paycXuLy->id;
                    if($data['ds_id_user_xu_ly']){
                        $dsCanBoNhans=explode(';', $data['ds_id_user_xu_ly']);
                        array_pop($dsCanBoNhans);
                        foreach ($dsCanBoNhans as $key => $canBoNhan) {
                            $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                            $paknCanBoNhanData['id_user_nhan']=$canBoNhan;
                            $paknCanBoNhanData['trang_thai']=0;
                            $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                        }
                    }else{
                        $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                        $paknCanBoNhanData['id_user_nhan']=$userId;
                        $paknCanBoNhanData['trang_thai']=0;
                        $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                    }
                        
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }




    public function frmChuyenLanhDao(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsId=explode(';', $dataForm['id']);
                if(count($dsId)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    $view=view('Payc::frm-chuyen-lanh-dao', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                    return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsId[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                array_pop($dsId); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null
                foreach ($dsId as $key => $id) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$id)->get()->toArray();
                    if(!is_numeric($id) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        $error="Không được chọn nhiều dịch vụ khác nhau!";
                        $view=view('Payc::frm-chuyen-lanh-dao', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                        return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                    }
                }
                // Điều kiện đúng thực hiện render form
                $data=UsersDichVu::layDanhSachLanhDao($userId);
                $error='';
                $view=view('Payc::frm-chuyen-lanh-dao', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau

            }
            $error='Vui lòng chọn PAYC cần chuyển xử lý!';
            $view=view('Payc::frm-chuyen-lanh-dao', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function chuyenLanhDao(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            //print_r($data);
            if(isset($data['ds_id_payc_chuyen_lanh_dao'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_chuyen_lanh_dao']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsIdPayc[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Kiểm tra tính hợp lệ của các payc
                foreach ($dsIdPayc as $key => $idPayc) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$idPayc)->get()->toArray();
                    if(!is_numeric($idPayc) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        return array("error"=>"Không được chọn nhiều dịch vụ khác nhau!");
                    }
                }
                // Thực hiện lưu thông tin
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','CHUYEN_LANH_DAO')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                $canBoXuLyYeuCau=array();
                if ($request->hasFile('file_xu_ly')) {
                    $canBoXuLyYeuCau['file_xu_ly']=\Helper::getAndStoreFile($request->file('file_xu_ly'));
                }
                foreach ($dsIdPayc as $key => $idPayc) {
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                    $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);

                    $idXuLyYeuCau=$paycXuLy->id;
                    if($data['ds_id_user_chuyen_lanh_dao']){
                        $dsCanBoNhans=explode(';', $data['ds_id_user_chuyen_lanh_dao']);
                        array_pop($dsCanBoNhans);
                        foreach ($dsCanBoNhans as $key => $canBoNhan) {
                            $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                            $paknCanBoNhanData['id_user_nhan']=$canBoNhan;
                            $paknCanBoNhanData['trang_thai']=0;
                            $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                        }
                    }else{
                        $dsDonVis=UsersDichVu::layDanhSachLanhDao($userId);
                        foreach ($dsDonVis as $key => $donVi) {
                            foreach ($donVi['ds_can_bo'] as $key => $canBoNhan) {
                                $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                                $paknCanBoNhanData['id_user_nhan']=$canBoNhan['id'];
                                $paknCanBoNhanData['trang_thai']=0;
                                $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                            }
                                
                        }
                    }
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function frmChuyenCapTren(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsId=explode(';', $dataForm['id']);
                if(count($dsId)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    $view=view('Payc::frm-chuyen-cap-tren', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                    return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsId[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                array_pop($dsId); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null
                foreach ($dsId as $key => $id) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$id)->get()->toArray();
                    if(!is_numeric($id) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        $error="Không được chọn nhiều dịch vụ khác nhau!";
                        $view=view('Payc::frm-chuyen-cap-tren', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                        return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                    }
                }
                // Điều kiện đúng thực hiện render form
                $data=UsersDichVu::layDanhSachDonViCapTren($userId);
                $error='';
                $view=view('Payc::frm-chuyen-cap-tren', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau

            }
            $error='Vui lòng chọn PAYC cần chuyển xử lý!';
            $view=view('Payc::frm-chuyen-cap-tren', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function chuyenCapTren(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            if(!$data['ds_id_don_vi_cap_tren']){
                return array("error"=>'Vui lòng chọn đơn vị cần chuyển');
            }
            //print_r($data);
            if(isset($data['ds_id_payc_chuyen_cap_tren'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_chuyen_cap_tren']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsIdPayc[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Kiểm tra tính hợp lệ của các payc
                foreach ($dsIdPayc as $key => $idPayc) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$idPayc)->get()->toArray();
                    if(!is_numeric($idPayc) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        return array("error"=>"Không được chọn nhiều dịch vụ khác nhau!");
                    }
                }
                // Thực hiện lưu thông tin
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','CHUYEN_DON_VI_CAP_TREN')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                $canBoXuLyYeuCau=array();
                if ($request->hasFile('file_xu_ly')) {
                    $canBoXuLyYeuCau['file_xu_ly']=\Helper::getAndStoreFile($request->file('file_xu_ly'));
                }
                foreach ($dsIdPayc as $key => $idPayc) {
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                    $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);

                    $idXuLyYeuCau=$paycXuLy->id;
                    if($data['ds_id_don_vi_cap_tren']){
                        $dsDonViCapTren=explode(';', $data['ds_id_don_vi_cap_tren']);
                        array_pop($dsDonViCapTren);
                        $maNhomChucVu=DmThamSoHeThong::getValueByName('MA_NHOM_CHUC_VU_NHAN_PAKN');
                        // Duyệt qua từng đơn vị nhận xác định danh sách cán bộ thuộc đơn vị và thực hiện chuyển cho cán bộ
                        foreach ($dsDonViCapTren as $key => $idDonVi) {
                            $dsCanBoNhans=UsersDichVu::layDanhSachCanBoTheoIdDonViVaMaNhomChucVu($idDonVi, $maNhomChucVu);
                            foreach ($dsCanBoNhans as $key => $canBoNhan) {
                                $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                                $paknCanBoNhanData['id_user_nhan']=$canBoNhan['id'];
                                $paknCanBoNhanData['trang_thai']=0;
                                $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                            }
                        }
                    }
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function frmHoanTat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsId=explode(';', $dataForm['id']);
                if(count($dsId)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    $view=view('Payc::frm-hoan-tat', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                    return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsId[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                array_pop($dsId); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null
                foreach ($dsId as $key => $id) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$id)->get()->toArray();
                    if(!is_numeric($id) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        $error="Không được chọn nhiều dịch vụ khác nhau!";
                        $view=view('Payc::frm-hoan-tat', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                        return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                    }
                }
                // Điều kiện đúng thực hiện render form
                $error='';
                $view=view('Payc::frm-hoan-tat', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau

            }
            $error='Vui lòng chọn PAYC cần chuyển xử lý!';
            $view=view('Payc::frm-hoan-tat', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function hoanTat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            if(isset($data['ds_id_payc_hoan_tat'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_hoan_tat']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsIdPayc[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                // Kiểm tra tính hợp lệ của các payc
                foreach ($dsIdPayc as $key => $idPayc) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$idPayc)->get()->toArray();
                    if(!is_numeric($idPayc) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        return array("error"=>"Không được chọn nhiều dịch vụ khác nhau!");
                    }
                }
                // Thực hiện lưu thông tin
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','HOAN_TAT')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                $canBoXuLyYeuCau=array();
                if ($request->hasFile('file_xu_ly')) {
                    $canBoXuLyYeuCau['file_xu_ly']=\Helper::getAndStoreFile($request->file('file_xu_ly'));
                }
                foreach ($dsIdPayc as $key => $idPayc) {                    
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                    $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);

                    $idXuLyYeuCau=$paycXuLy->id;
                    $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                    $paknCanBoNhanData['id_user_nhan']=1;
                    $userTao=Payc::select('id_user_tao')->where('id','=',$idPayc)->get()->toArray();
                    if($userTao){
                        $paknCanBoNhanData['id_user_nhan']=$userTao[0]['id_user_tao'];
                    }
                    $paknCanBoNhanData['trang_thai']=0;
                    $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function frmTraLaiKhongXuLy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsId=explode(';', $dataForm['id']);
                if(count($dsId)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    $view=view('Payc::frm-tra-lai-khong-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                    return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsId[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                array_pop($dsId); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null
                foreach ($dsId as $key => $id) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$id)->get()->toArray();
                    if(!is_numeric($id) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        $error="Không được chọn nhiều dịch vụ khác nhau!";
                        $view=view('Payc::frm-tra-lai-khong-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                        return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                    }
                }
                // Điều kiện đúng thực hiện render form
                $error='';
                $view=view('Payc::frm-tra-lai-khong-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau

            }
            $error='Vui lòng chọn PAYC cần chuyển xử lý!';
            $view=view('Payc::frm-tra-lai-khong-xu-ly', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function traLaiKhongXuLy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            //print_r($data);
            if(isset($data['ds_id_payc_tra_lai_khong_xu_ly'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_tra_lai_khong_xu_ly']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsIdPayc[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                
                // Kiểm tra tính hợp lệ của các payc
                foreach ($dsIdPayc as $key => $idPayc) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$idPayc)->get()->toArray();
                    if(!is_numeric($idPayc) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        return array("error"=>"Không được chọn nhiều dịch vụ khác nhau!");
                    }
                }
                // Thực hiện lưu thông tin
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','TRA_LAI_NGUOI_TAO')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                $canBoXuLyYeuCau=array();
                if ($request->hasFile('file_xu_ly')) {
                    $canBoXuLyYeuCau['file_xu_ly']=\Helper::getAndStoreFile($request->file('file_xu_ly'));
                }
                foreach ($dsIdPayc as $key => $idPayc) {                    
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                    $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);

                    $idXuLyYeuCau=$paycXuLy->id;
                    $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                    $paknCanBoNhanData['id_user_nhan']=1;
                    $userTao=Payc::select('id_user_tao')->where('id','=',$idPayc)->get()->toArray();
                    if($userTao){
                        $paknCanBoNhanData['id_user_nhan']=$userTao[0]['id_user_tao'];
                    }
                    $paknCanBoNhanData['trang_thai']=0;
                    $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function frmHuy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsId=explode(';', $dataForm['id']);
                if(count($dsId)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    $view=view('Payc::frm-huy', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                    return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsId[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                array_pop($dsId); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null
                foreach ($dsId as $key => $id) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$id)->get()->toArray();
                    if(!is_numeric($id) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        $error="Không được chọn nhiều dịch vụ khác nhau!";
                        $view=view('Payc::frm-huy', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                        return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                    }
                }
                // Điều kiện đúng thực hiện render form
                $error='';
                $view=view('Payc::frm-huy', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau

            }
            $error='Vui lòng chọn PAYC cần chuyển xử lý!';
            $view=view('Payc::frm-huy', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function huy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            //print_r($data);
            if(isset($data['ds_id_payc_huy'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_huy']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsIdPayc[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }                
                // Kiểm tra tính hợp lệ của các payc
                foreach ($dsIdPayc as $key => $idPayc) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$idPayc)->get()->toArray();
                    if(!is_numeric($idPayc) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        return array("error"=>"Không được chọn nhiều dịch vụ khác nhau!");
                    }
                }
                // Thực hiện lưu thông tin
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','HUY')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                $canBoXuLyYeuCau=array();
                if ($request->hasFile('file_xu_ly')) {
                    $canBoXuLyYeuCau['file_xu_ly']=\Helper::getAndStoreFile($request->file('file_xu_ly'));
                }
                foreach ($dsIdPayc as $key => $idPayc) {                    
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                    $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);

                    $idXuLyYeuCau=$paycXuLy->id;
                    $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                    $paknCanBoNhanData['id_user_nhan']=1;
                    $userTao=Payc::select('id_user_tao')->where('id','=',$idPayc)->get()->toArray();
                    if($userTao){
                        $paknCanBoNhanData['id_user_nhan']=$userTao[0]['id_user_tao'];
                    }
                    $paknCanBoNhanData['trang_thai']=0;
                    $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function frmCapNhatPayc(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array(); $dichVus=array();
            $idUser=Auth::id();
            if(!$idUser){
                $error="Lỗi chưa đăng nhập vào hệ thống.";
                $view=view('Payc::frm-cap-nhat-payc', compact('data','dichVus','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
            }
            $dichVus=DichVu::all()->toArray();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = Payc::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }  
            $view=view('Payc::frm-cap-nhat-payc', compact('data','dichVus','error'))->render(); // Trả dữ liệu ra view  
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function capNhatPayc(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id_payc_cap_nhat'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id_payc_cap_nhat']; //ngược lại có id
            $dataForm['id']=$id;
            unset($dataForm['id_payc_cap_nhat']);
            $payc=Payc::where("id","=",$id)->get()->toArray();
            if(count($payc)==1){
                unset($dataForm["_token"]);
                $payc=Payc::findOrFail($id);
                $file='';
                if ($request->hasFile('file_payc')) {
                    $file=\Helper::getAndStoreFile($request->file('file_payc'));
                    $dataForm['file_payc']=$payc->file_payc.$file;
                }
                $payc->update($dataForm);

                // Thực hiện lưu thông tin
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','CAP_NHAT')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                $canBoXuLyYeuCau['id_payc']=$id;
                $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                $canBoXuLyYeuCau['noi_dung_xu_ly']=$dataForm['noi_dung'];
                $canBoXuLyYeuCau['file_xu_ly']=$file;
                $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);

                $idXuLyYeuCau=$paycXuLy->id;
                $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                $paknCanBoNhanData['id_user_nhan']=$userId;
                $paknCanBoNhanData['trang_thai']=0;
                $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);

                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }



    

    public function danhSachPaycChoDuyet(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycChoDuyet($userId);
            return view('Payc::danh-sach-payc-cho-duyet', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-cho-duyet', compact('paycs','error'));
    }  

    public function frmDuyet(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsId=explode(';', $dataForm['id']);
                if(count($dsId)<2){
                    $error='Vui lòng chọn PAYC cần xử lý!';
                    $view=view('Payc::frm-duyet', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                    return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsId[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                array_pop($dsId); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null
                foreach ($dsId as $key => $id) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$id)->get()->toArray();
                    if(!is_numeric($id) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        $error="Không được chọn nhiều dịch vụ khác nhau!";
                        $view=view('Payc::frm-duyet', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                        return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                    }
                }
                // Điều kiện đúng thực hiện render form
                $data=UsersDichVu::layDanhSachLanhDao($userId);
                $error='';
                $view=view('Payc::frm-duyet', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau

            }
            $error='Vui lòng chọn PAYC cần chuyển xử lý!';
            $view=view('Payc::frm-duyet', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function duyet(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax

            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            if(isset($data['ds_id_payc_duyet'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_duyet']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsIdPayc[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }                
                // Kiểm tra tính hợp lệ của các payc
                foreach ($dsIdPayc as $key => $idPayc) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$idPayc)->get()->toArray();
                    if(!is_numeric($idPayc) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        return array("error"=>"Không được chọn nhiều dịch vụ khác nhau!");
                    }
                }
                 // Thực hiện lưu thông tin
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','DUYET')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                $canBoXuLyYeuCau=array();
                if ($request->hasFile('file_xu_ly')) {
                    $canBoXuLyYeuCau['file_xu_ly']=\Helper::getAndStoreFile($request->file('file_xu_ly'));
                }
                foreach ($dsIdPayc as $key => $idPayc) {
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                    $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);


                    $idXuLyYeuCau=$paycXuLy->id;
                    if($data['ds_id_user_duyet']){
                        $dsCanBoNhans=explode(';', $data['ds_id_user_duyet']);
                        array_pop($dsCanBoNhans);
                        foreach ($dsCanBoNhans as $key => $canBoNhan) {
                            $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                            $paknCanBoNhanData['id_user_nhan']=$canBoNhan;
                            $paknCanBoNhanData['trang_thai']=0;
                            $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                        }
                    }else{
                        $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                        $paknCanBoNhanData['id_user_nhan']=$userId;
                        $paknCanBoNhanData['trang_thai']=0;
                        $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                    }




                        
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function frmChuyenBoPhanTiepNhanVaXuLyPayc(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsId=explode(';', $dataForm['id']);
                if(count($dsId)<2){
                    $error='Vui lòng chọn PAYC cần xử lý!';
                    $view=view('Payc::frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                    return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsId[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                array_pop($dsId); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null
                foreach ($dsId as $key => $id) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$id)->get()->toArray();
                    if(!is_numeric($id) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        $error="Không được chọn nhiều dịch vụ khác nhau!";
                        $view=view('Payc::frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                        return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
                    }
                }
                // Điều kiện đúng thực hiện render form
                $data=UsersDichVu::layDanhSachCanBoTiepNhanVaXuLy($userId);
                $error='';
                $view=view('Payc::frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau

            }
            $error='Vui lòng chọn PAYC cần chuyển xử lý!';
            $view=view('Payc::frm-chuyen-bo-phan-tiep-nhan-va-xu-ly-payc', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function chuyenBoPhanTiepNhanVaXuLyPayc(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax

            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống!');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            if(isset($data['ds_id_payc_chuyen_bo_phan_tiep_nhan_va_xu_ly_payc'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_chuyen_bo_phan_tiep_nhan_va_xu_ly_payc']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Lấy dịch vụ đầu tiên ra để đối chiếu với các dịch vụ còn lại phải thống nhất 1 dịch vụ
                $idDichVuFirst=0;
                $dichVuFist=Payc::select('id_dich_vu')->where('id','=',$dsIdPayc[0])->get()->toArray();
                if($dichVuFist){
                    $idDichVuFirst=$dichVuFist[0]['id_dich_vu'];
                }
                // Kiểm tra tính hợp lệ của các payc
                foreach ($dsIdPayc as $key => $idPayc) {
                    // kiểm tra id có hợp lệ không
                    $dichVu=Payc::select('id_dich_vu')->where('id','=',$idPayc)->get()->toArray();
                    if(!is_numeric($idPayc) || !$dichVu || $dichVu[0]['id_dich_vu']!=$idDichVuFirst){
                        return array("error"=>"Không được chọn nhiều dịch vụ khác nhau!");
                    }
                }
                 // Thực hiện lưu thông tin
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','CHUYEN_CAN_BO')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                $canBoXuLyYeuCau=array();
                if ($request->hasFile('file_xu_ly')) {
                    $canBoXuLyYeuCau['file_xu_ly']=\Helper::getAndStoreFile($request->file('file_xu_ly'));
                }
                foreach ($dsIdPayc as $key => $idPayc) {
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                    $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                    $canBoXuLyYeuCau['ds_id_user_nhan']=$data['ds_id_user_chuyen_bo_phan_tiep_nhan_va_xu_ly_payc'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);

                    $idXuLyYeuCau=$paycXuLy->id;
                    if($data['ds_id_user_chuyen_bo_phan_tiep_nhan_va_xu_ly_payc']){
                        $dsCanBoNhans=explode(';', $data['ds_id_user_chuyen_bo_phan_tiep_nhan_va_xu_ly_payc']);
                        array_pop($dsCanBoNhans);
                        foreach ($dsCanBoNhans as $key => $canBoNhan) {
                            $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                            $paknCanBoNhanData['id_user_nhan']=$canBoNhan;
                            $paknCanBoNhanData['trang_thai']=0;
                            $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                        }
                    }else{
                        $dsDonVis=UsersDichVu::layDanhSachCanBoTiepNhanVaXuLy($userId);
                        foreach ($dsDonVis as $key => $donVi) {
                            foreach ($donVi['ds_can_bo'] as $key => $canBoNhan) {
                                $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                                $paknCanBoNhanData['id_user_nhan']=$canBoNhan['id'];
                                $paknCanBoNhanData['trang_thai']=0;
                                $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                            }
                                
                        }
                    }
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function danhSachPaycDaHoanTat(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
         // Thực hiện lưu thông tin
        $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','LD_DANH_GIA')->get()->toArray();
        $idLDDanhGia=0;
        if($trangThai){
            $idLDDanhGia=$trangThai[0]['id'];
        }
        

        $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','KH_DANH_GIA')->get()->toArray();
        $idKHDanhGia=0;
        if($trangThai){
            $idKHDanhGia=$trangThai[0]['id'];
        }



        if($userId){
            $paycs=Payc::getDanhSachPaycDaHoanTat($userId);
            return view('Payc::danh-sach-payc-da-hoan-tat', compact('paycs', 'idKHDanhGia', 'idLDDanhGia','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-da-hoan-tat', compact('paycs', 'idKHDanhGia', 'idLDDanhGia','error'));
    } 


    public function chuyenKHDanhGia(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array('error'=>"Chưa đăng nhập vào hệ thống");
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $dsIdPayc=explode(';', $data['id']);
            $lastIndex=count($dsIdPayc)-1;
            if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
            }
            // Tạo lịch sử xử lý là tạo yêu cầu
            $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','KH_DANH_GIA')->get()->toArray();
            if(count($trangThai)<1){
                return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
            }
            $idXuLy=$trangThai[0]['id'];
            foreach ($dsIdPayc as $key => $idPayc) {
                $payc=Payc::where('id','=',$idPayc)->get()->toArray();
                if(count($payc)>0){
                    $canBoXuLyYeuCau['id_payc']=$idPayc;
                    $canBoXuLyYeuCau['id_user_xu_ly']=$userId;
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $canBoXuLyYeuCau['noi_dung_xu_ly']='';
                    $canBoXuLyYeuCau['file_xu_ly']='';
                    $canBoXuLyYeuCau['state']=0;
                    $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);

                    $idXuLyYeuCau=$paycXuLy->id;
                    $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                    $paknCanBoNhanData['id_user_nhan']=$payc[0]['id_user_tao'];
                    $paknCanBoNhanData['trang_thai']=0;
                    $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                }
                
            }
                
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function danhGia(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                return array("error"=>'Chưa đăng nhập vào hệ thống.');
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            if(isset($data['ds_id_payc_danh_gia'])){ // ngược lại dữ liệu hợp lệ
                // Cắt lấy từng id ra, do id lúc gửi qua theo dạng danh sách cách nhau bởi dấu ;
                $dsIdPayc=explode(';', $data['ds_id_payc_danh_gia']);
                if(count($dsIdPayc)<2){
                    $error='Vui lòng chọn PAYC cần chuyển xử lý!';
                    return array("error"=>$error);
                }
                $lastIndex=count($dsIdPayc)-1;
                if(isset($dsIdPayc[$lastIndex]) and $dsIdPayc[$lastIndex]==null){
                    array_pop($dsIdPayc); // bỏ phần tử cuối vì phần tử cuối do cắt theo dấu ; sẽ bị null    
                }
                // Kiểm tra lại danh sách đã gửi có hợp lý hay ko
                $dsIdCanBoXuLy=array();
                foreach ($dsIdPayc as $key => $idPayc) {
                    // nếu là lãnh đạo đánh giá
                    if($data['loai_danh_gia']==1){
                        $canBoXuLyYeuCau=PaycXuLy::checkHoanTatById($idPayc,1);
                        if(count($canBoXuLyYeuCau)<=0){
                            return array("error"=>'Không thể đánh giá, do chưa hoàn tất hoặc đã được đánh giá.');
                        }
                        $dsIdCanBoXuLy[$idPayc]=$canBoXuLyYeuCau[0]['id'];
                    }else{ // ngược lại
                        $canBoXuLyYeuCau=PaycXuLy::checkHoanTatById($idPayc,2);
                        if(count($canBoXuLyYeuCau)<=0){
                            return array("error"=>'Không thể đánh giá, do chưa hoàn tất hoặc đã được đánh giá.');
                        }
                        $dsIdCanBoXuLy[$idPayc]=$canBoXuLyYeuCau[0]['id'];
                    }
                }
                // Tạo lịch sử xử lý là tạo yêu cầu
                $trangThai=PaycTrangThaiXuLy::where('ma_trang_thai','=','LD_DANH_GIA')->get()->toArray();
                if(count($trangThai)<1){
                    return array("error"=>"Lỗi trạng thái xử lý vui lòng liên hệ quản trị");
                }
                $idXuLy=$trangThai[0]['id'];
                // Duyệt qua danh sách lưu đánh giá lại
                foreach ($dsIdPayc as $key => $idPayc) {
                    if($data['loai_danh_gia']==1){ // nếu là lãnh đạo thì thêm dòng đánh giá trực tiếp luôn
                        // insert đánh giá
                        $canBoXuLyYeuCau['id_payc']=$idPayc;
                        $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                        $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                        $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                        $canBoXuLyYeuCau['state']=1;
                        $paycXuLy=PaycXuLy::create($canBoXuLyYeuCau);

                        $idXuLyYeuCau=$paycXuLy->id;
                        $paknCanBoNhanData['id_xu_ly_yeu_cau']=$idXuLyYeuCau;
                        $paknCanBoNhanData['id_user_nhan']=$userId;
                        $paknCanBoNhanData['trang_thai']=1;
                        $paknCanBoNhan=PaycCanBoNhan::create($paknCanBoNhanData);
                    }else{ // ngược lại là khách hàng đánh giá thì chỉ sửa lại trạng thái đánh giá thôi vì dòng dữ liệu đánh giá đã được thêm ở lúc lãnh đạo chuyển khách hàng đánh giá rồi
                        $canBoXuLyYeuCau=PaycXuLy::findOrFail($dsIdCanBoXuLy[$idPayc]);
                        $canBoXuLyYeuCau->noi_dung_xu_ly=$data['noi_dung_xu_ly'];
                        $canBoXuLyYeuCau->state=1;
                        $canBoXuLyYeuCau->update();
                    }
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Lỗi dữ liệu không hợp lệ.'); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function qtxl(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = PaycXuLy::getQtxlById($dataForm['id']); // kiểm tra dữ liệu trong DB
            }else{
                $error="Không tìm thấy dữ liệu cần xem";
            }   
            $view=view('Payc::qtxl', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function danhSachPaycTheoTaiKhoan(Request $request){
        $userId=Auth::id();
        if(!$userId){
            return array("error"=>'Chưa đăng nhập vào hệ thống!');
        }
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::danhSachPaycTheoTaiKhoan($userId);
            return view('Payc::danh-sach-payc-theo-tai-khoan', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-theo-tai-khoan', compact('paycs','error'));
    }

    public function danhSachPaycChuaCoCanBoNhan(Request $request){
        $userId=Auth::id();
        if(!$userId){
            return array("error"=>'Chưa đăng nhập vào hệ thống!');
        }
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::danhSachPaycChuaCoCanBoNhan($userId);
            return view('Payc::danh-sach-payc-chua-co-can-bo-nhan', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-chua-co-can-bo-nhan', compact('paycs','error'));
    }

    
}