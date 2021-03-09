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
use App\PaycCanBoXuLuYeuCau;
use App\UsersDichVu;
use App\PaycTrangThaiXuLy;
use App\DmQuanHuyen;
use App\DmPhuongXa;
use App\UsersDonVi;
use App\DmThamSoHeThong;
use App\DichVu;
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
        /*$dichVus=DonVi::layCanBoThuocCapHuyenTheoMaHuyen(842);
        echo '<pre>';
        print_r($dichVus);
        echo '</pre>';
        die();*/



        $idUser=1;
        if(Auth::id()){
            $idUser=Auth::id();
        }
        $dmQuanHuyens=DmQuanHuyen::all()->toArray();
        $dmPhuongXas=DmPhuongXa::all()->toArray();
        $donViMacDinh=UsersDonVi::getDonViMacDinh($idUser);
        $dichVus=UsersDichVu::getUserDichVuByIdUser($idUser);
        return view('Payc::payc', compact('dichVus', 'dmQuanHuyens','dmPhuongXas','donViMacDinh'));
    }

    public function danhSachPaycAnDanh(Request $request){
        $error=''; // Khai báo biến
        $paycs=Payc::where('id_user_tao','=',1)->get()->toArray();
        return view('Payc::danh-sach-payc-an-danh', compact('paycs','error'));
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
            $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);

            
            $maNhomDichVu=DichVu::getMaNhomDichVuByIdDichVu($data['id_dich_vu']);
            if($maNhomDichVu=='DV_CNTT'){ // Nếu nhóm dịch vụ công nghệ thông tin thì cấp trung tâm tiếp nhận

            }else{ // Nếu nhóm dịch vụ viễn thông thì cấp xã hoặc huyện tiếp nhận
                // Lấy thông tin cấp xử lý 
                $capMacDinh=DmThamSoHeThong::getValueByName('CAP_TIEP_NHAN_MAC_DINH');
                if($capMacDinh=='XA'){
                    $maXa=$data['ma_phuong_xa'];
                }elseif ($capMacDinh=='HUYEN') {
                    $maHuyen=$data['ma_quan_huyen'];

                }else{ // Ngược lại không thuộc cấp nào hết

                }
            }
            
            
            

            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function danhSachPaycChoTiepNhan(Request $request){
        $userId=Auth::id();
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
                $data=UsersDichVu::getDanhSachUsersDichVuByDichVuId($idDichVuFirst);
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
                    // $canBoXuLyYeuCau['id_xu_ly']=$idXuLyTiepNhan;
                    // $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLyChuyenXuLy;
                    $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function danhSachPaycChoXuLy(Request $request){
        $userId=Auth::id();
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
                $data=UsersDichVu::getDanhSachUsersDichVuByDichVuId($idDichVuFirst);
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
                    $canBoXuLyYeuCau['ds_id_user_nhan']=$data['ds_id_user_xu_ly'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }




    public function frmChuyenLanhDao(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
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
                $data=UsersDichVu::getDanhSachUsersDichVuByDichVuId($idDichVuFirst);
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
                    $canBoXuLyYeuCau['ds_id_user_nhan']=$data['ds_id_user_chuyen_lanh_dao'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function frmHoanTat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
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
                    $canBoXuLyYeuCau['ds_id_user_nhan']="1".';';
                    $userTao=Payc::select('id_user_tao')->where('id','=',$idPayc)->get()->toArray();
                    if($userTao){
                        $canBoXuLyYeuCau['ds_id_user_nhan']=$userTao[0]['id_user_tao'].';';
                    }
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function frmTraLaiKhongXuLy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
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
                    $canBoXuLyYeuCau['ds_id_user_nhan']="1".';';
                    $userTao=Payc::select('id_user_tao')->where('id','=',$idPayc)->get()->toArray();
                    if($userTao){
                        $canBoXuLyYeuCau['ds_id_user_nhan']=$userTao[0]['id_user_tao'].';';
                    }
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }



    public function frmHuy(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
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
                    $canBoXuLyYeuCau['ds_id_user_nhan']="1".';';
                    $userTao=Payc::select('id_user_tao')->where('id','=',$idPayc)->get()->toArray();
                    if($userTao){
                        $canBoXuLyYeuCau['ds_id_user_nhan']=$userTao[0]['id_user_tao'].';';
                    }
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function frmCapNhatPayc(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array(); $dichVus=array();
            $idUser=Auth::id();
            if(!$idUser){
                $error="Lỗi chưa đăng nhập vào hệ thống.";
                $view=view('Payc::frm-cap-nhat-payc', compact('data','dichVus','error'))->render(); // Trả dữ liệu ra view trước     
                return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
            }
            $dichVus=UsersDichVu::getUserDichVuByIdUser($idUser);
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
                $canBoXuLyYeuCau['ds_id_user_nhan']=$userId.';';
                $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);

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
                $data=UsersDichVu::getDanhSachUsersDichVuByDichVuId($idDichVuFirst);
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
                    $canBoXuLyYeuCau['ds_id_user_nhan']=$data['ds_id_user_duyet'];
                    $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                    $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
                }
                return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
            }
            return array("error"=>'Dữ liệu không hợp lệ vui lòng kiểm tra lại!'); // Trả về thông báo lưu dữ liệu thất bại
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function frmChuyenBoPhanTiepNhanVaXuLyPayc(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
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
                $data=UsersDichVu::getDanhSachUsersDichVuByDichVuId($idDichVuFirst);
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
                    $xuLyTiepNhan=PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
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
                    $canBoXuLyYeuCau['ds_id_user_nhan']=$payc[0]['id_user_tao'].';';
                    $canBoXuLyYeuCau['file_xu_ly']='';
                    $canBoXuLyYeuCau['state']=0;
                    PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
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
                        $canBoXuLyYeuCau=PaycCanBoXuLuYeuCau::checkHoanTatById($idPayc,1);
                        if(count($canBoXuLyYeuCau)<=0){
                            return array("error"=>'Không thể đánh giá, do chưa hoàn tất.');
                        }
                        $dsIdCanBoXuLy[$idPayc]=$canBoXuLyYeuCau[0]['id'];
                    }else{ // ngược lại
                        $canBoXuLyYeuCau=PaycCanBoXuLuYeuCau::checkHoanTatById($idPayc,2);
                        if(count($canBoXuLyYeuCau)<=0){
                            return array("error"=>'Không thể đánh giá, do chưa hoàn tất.');
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
                    if($data['loai_danh_gia']==1){
                        // insert đánh giá
                        $canBoXuLyYeuCau['id_payc']=$idPayc;
                        $canBoXuLyYeuCau['id_user_xu_ly']=$userId;                    
                        $canBoXuLyYeuCau['noi_dung_xu_ly']=$data['noi_dung_xu_ly'];
                        $canBoXuLyYeuCau['ds_id_user_nhan']=$userId.';';
                        $canBoXuLyYeuCau['id_xu_ly']=$idXuLy;
                        $canBoXuLyYeuCau['state']=1;
                        PaycCanBoXuLuYeuCau::create($canBoXuLyYeuCau);
                    }else{
                        $canBoXuLyYeuCau=PaycCanBoXuLuYeuCau::findOrFail($dsIdCanBoXuLy[$idPayc]);
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
                $data = PaycCanBoXuLuYeuCau::getQtxlById($dataForm['id']); // kiểm tra dữ liệu trong DB
            }else{
                $error="Không tìm thấy dữ liệu cần xem";
            }   
            $view=view('Payc::qtxl', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    } 
}