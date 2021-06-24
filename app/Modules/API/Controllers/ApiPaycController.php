<?php
namespace App\Modules\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Http\Controllers\Controller;
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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ApiPaycController extends Controller
{
    
    public function apiGuiPakn(Request $request){
        $request->validate([
            'id_user'               => 'nullable|numeric',
            'email'                 => 'nullable|string',
            'id_dich_vu'            => 'required|numeric',
            'tieu_de'               => 'required|string',
            'noi_dung'              => 'nullable|string',
            'ma_phuong_xa'          => 'numeric',
            'vi_do'                 => 'nullable|string',
            'kinh_do'               => 'nullable|string',
            'han_xu_ly_mong_muon'   => 'nullable|date',
            'is_an_danh'            => 'numeric'
        ]);
        $userId=1;
        if($request->id_user && $request->email){
            $user=User::where('id','=',$request->id_user)->where('email','=',$request->email)->get()->toArray();
            if($user){
                $userId=$user[0]['id'];
            }else{
                return response()->json(
                    [
                        'message'   => 'Tài khoản không hợp lệ',
                        'error'     => 2
                    ]
                );
            }
        }
        $fullFileName='';
        /*foreach ($request->file_payc as $key => $fullFileData) {
            $file = base64_decode($fullFileData['file_data']);
            $fileName='api_'.time().'_'.$key.$fullFileData['file_name'];        
            $fileName=str_replace(' ','',$fileName);
            $path = storage_path()."/app/public/file/payc/".$fileName;
            $success=file_put_contents($path, $file);
            if($success){
                $fullFileName.=$fileName.';';
            }
        }*/
        // hoặc nếu bật chế độ ẩn danh cũng tiếp nhận ẩn danh luôn
        if($request->is_an_danh==1){ // nếu là ẩn danh thì user id =1
            $userId=1;
        }
        $data['id_user_tao']=$userId;
        $data['id_dich_vu']=$request->id_dich_vu;
        $data['so_phieu']=Payc::taoSoPhieu();
        $data['tieu_de']=$request->tieu_de;
        $data['noi_dung']=$request->noi_dung;
        $data['ma_phuong_xa']=$request->ma_phuong_xa;
        $data['vi_do']=$request->vi_do;
        $data['kinh_do']=$request->kinh_do;
        $data['file_payc']=$fullFileName;
        $data['ngay_tao']=date('Y-m-d H:i:s');
        $data['han_xu_ly_mong_muon']=$request->han_xu_ly_mong_muon;
        $data['han_xu_ly_duoc_giao']=null;
        $data['ngay_hoan_tat']=null;
        $data['trang_thai']=1;

           
        $payc=Payc::create($data); // Lưu dữ liệu vào DB
        $idPayc=$payc->id;

        // Tạo lịch sử xử lý là tạo yêu cầu
        $trangThaiTiepNhan=PaycTrangThaiXuLy::where('ma_trang_thai','=','TAO_MOI')->get()->toArray();
        if(count($trangThaiTiepNhan)<1){
            return response()->json(
                [
                    'message'   => 'Lỗi không tìm thấy trạng thái xử lý vui lòng liên hệ quản trị',
                    'error'     => 1
                ]
            );
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
        elseif($maNhomDichVu=='DV_XA'){ // Có thể mở rộng chỗ này: nếu nhóm dịch vụ công nghệ thông tin thì cấp trung tâm tiếp nhận
            $dsCanBoNhans=DonVi::layCanBoThuocCapXaTheoMaPhuongXaVaMaNhomChucVu($maPhuongXa,$nhomChucVuNhanPakn, $idDichVu);
        }
        elseif($maNhomDichVu=='DV_HUYEN'){
            $dsCanBoNhans=DonVi::layCanBoThuocCapHuyenTheoMaHuyenVaMaNhomChucVu($maHuyen,$nhomChucVuNhanPakn, $idDichVu);
        }
        elseif($maNhomDichVu=='DV_TTVT'){
            $dsCanBoNhans=DonVi::layCanBoThuocCapTtvtTheoMaHuyenVaMaNhomChucVu($maHuyen,$nhomChucVuNhanPakn, $idDichVu);
        }
        elseif($maNhomDichVu=='DV_DHTT'){
            $dsCanBoNhans=DonVi::layCanBoThuocCapTrungTamTheoMaNhomChucVu('TTDHTT',$nhomChucVuNhanPakn, $idDichVu);
        }
        elseif($maNhomDichVu=='DV_KD'){
            $dsCanBoNhans=DonVi::layCanBoThuocCapTrungTamTheoMaNhomChucVu('TTKD',$nhomChucVuNhanPakn, $idDichVu);
        }
        elseif($maNhomDichVu=='DV_CNTT'){
            $dsCanBoNhans=DonVi::layCanBoThuocCapTrungTamTheoMaNhomChucVu('TTCNTT',$nhomChucVuNhanPakn, $idDichVu);
        }else{
            $arrMaNhom=explode('_', $maNhomDichVu);
            $countArrMaNhom=count($arrMaNhom)-1;
            $maNhomDichVu=$arrMaNhom[$countArrMaNhom];
            $dsCanBoNhans=DonVi::layCanBoThuocCapTrungTamTheoMaNhomChucVu($maNhomDichVu,$nhomChucVuNhanPakn, $idDichVu);
        }
        // Nếu nhóm chức vụ nhận là LANH_DAO hoặc XU_LY thì ghi thêm log chuyển lãnh đạo hoặc chuyển xử lý
        if($nhomChucVuNhanPakn=='LANH_DAO'){
            // Tạo lịch sử xử lý là chuyển lãnh đạo
            $trangThaiTiepNhan=PaycTrangThaiXuLy::where('ma_trang_thai','=','CHUYEN_LANH_DAO')->get()->toArray();
            if(count($trangThaiTiepNhan)<1){
                return response()->json(
                    [
                        'message'   => 'Lỗi không tìm thấy trạng thái xử lý vui lòng liên hệ quản trị',
                        'error'     => 1
                    ]
                );
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
                return response()->json(
                    [
                        'message'   => 'Lỗi không tìm thấy trạng thái xử lý vui lòng liên hệ quản trị',
                        'error'     => 1
                    ]
                );
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

        return response()->json(
            [
                'message'   => 'Gửi PAKN thành công',
                'error'     => 0,
                'pakn_id'   => $idPayc
            ]
        );
    }

    public function layPaycCuaToi(Request $request){
        $request->validate([
            'id_user'               => 'nullable|numeric',
            'email'                 => 'nullable|string'
        ]);
        $userId=1;
        if($request->id_user && $request->email){
            $user=User::where('id','=',$request->id_user)->where('email','=',$request->email)->get()->toArray();
            if($user){
                $userId=$user[0]['id'];
            }else{
                return response()->json(
                    [
                        'message'   => 'Tài khoản không hợp lệ',
                        'error'     => 2
                    ]
                );
            }
        }
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycCuaToi($userId);
        }
        return response()->json(
            [
                'message'   => 'Lấy dữ liệu thành công',
                'error'     => 0,
                'data'      => $paycs
            ]
        );
    }


    public function getFile(Request $request){
        $request->validate([
            'file'               => 'required|string'
        ]);
        //$file = file_get_contents('http://www.orimi.com/pdf-test.pdf'); 
        if (file_exists(storage_path('app/public/file/payc/'.$request->file))) {
            $file=File::get(storage_path('app/public/file/payc/'.$request->file));
            // Encode the image string data into base64 
            $data = base64_encode($file);
            // Display the output  or send $data
            $result=array(
                'error'=>0,
                'message'   => 'Lấy dữ liệu thành công',
                'file'  =>$request->file,
                'data'  =>$data
            );
        }else{
            $result=array(
                'error'=>1,
                'message'   => 'Lấy dữ liệu thất bại',
                'file'  =>$request->file,
                'data'  =>null
            );
        }
            
        return response()->json($result);
    }



    public function luuFile(Request $request){
        $request->validate([
            'pakn_id'               => 'required|numeric',
            'file_name'               => 'required|string',
            'file_data'               => 'required'
            
        ]);

        $file=$request->file('file_data');
        $fileName='api_'.time().'_'.$request->file_name;        
        $fileName=str_replace(' ','',$fileName);
        $path = $file->storeAs('public/file/payc', $fileName);

        // Tìm id pakn và lưu file vô

        // Thành công
        $result=array(
            'error'=>0,
            'message'   => 'Lấy dữ liệu thành công',
            'file_name'  => $fileName
        );

        return response()->json($result);
    }
}
?>