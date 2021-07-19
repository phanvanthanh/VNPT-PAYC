<?php
namespace App\Modules\TrangChu\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Request as RequestAjax;
use App\SsoModel;
use App\User;
use Firebase\JWT\JWT;
use Session;
use App\DmThamSoHeThong;
use App\BcDmThoiGianBaoCao;
use App\ToDo;


class TrangChuController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    public function home(Request $request){    
        if ($request->isMethod('POST')) {
            JWT::$leeway += 600;
            if ((isset($request->token))) {
                $ma_bao_mat = "vnpt-dntt";  
                try {
                    $token=$request->token;
                    $token_decode = JWT::decode($request->token, $ma_bao_mat, ['HS256']);                
                    $base64IdNhanVien = $token_decode->nhanvien_id;
                    $idNhanVien=base64_decode($base64IdNhanVien);
                    // Lấy user để đăng nhập bên hệ thống mình
                    $checkUserExits=User::where('sso_nhanvien_id','=',$idNhanVien)->get()->toArray();  

                    if(count($checkUserExits)>0){
                        $userId=$checkUserExits[0]['id'];
                        // Đăng nhập bằng user id
                        if (Auth::loginUsingId($userId)) {
                            Session::put('sso_login',1);
                            return redirect()->intended('/');
                        }else{
                            header('Location: https://portal.vnpttravinh.vn/');
                            exit;
                        }
                    }else{
                        header('Location: https://portal.vnpttravinh.vn/');
                        exit;
                    }
                        
                }catch(\Firebase\JWT\ExpiredException $e){
                    header('Location: https://portal.vnpttravinh.vn/');
                    exit;
                }
                catch (Exception $e) {
                    header('Location: https://portal.vnpttravinh.vn/');
                    exit;
                }
            } else {
                header('Location: https://portal.vnpttravinh.vn/');
                exit;
            }
            // Đăng nhập thất bại
            $request->session()->flash('notification-error', '<b>Đăng nhập thất bại</b>! '.$respone['message']);
            return redirect()->route('login');
        }else{ 
            $userId=0;
            if(Auth::id()){
                $userId=Auth::id();
                $choPhepTruyCapTrangchu=DmThamSoHeThong::getValueByName('CHO_PHEP_TRUY_CAP_TRANG_CHU');
                if($choPhepTruyCapTrangchu){
                    $tuanHienTai=\Helper::layTuanHienTaiCuaHeThong();
                    return view('TrangChu::home', compact('tuanHienTai'));
                }
            }else{
                $urlLogin=DmThamSoHeThong::getValueByName('URL_LOGIN');
                if($urlLogin){
                    header('Location: '.$urlLogin);
                    exit;
                }
                return redirect()->route('login');
                    
            }
            
            
        }
        
    }

    public function gioiThieu(Request $request){ 
        return view('TrangChu::gioi-thieu');
    }


    public function danhSachLichCaNhanTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $userId=0;
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $nam=$data['nam'];
            $thang=$data['thang'];
            $tuan=$data['tuan'];
            
            $dateOfWeek=BcDmThoiGianBaoCao::getStartAndEndDateOfWeekFull($nam, $tuan);
            $view=view('TrangChu::danh-sach-lich-ca-nhan-theo-tuan', compact('error', 'dateOfWeek', 'userId'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }


    public function danhSachLichCaNhanThang(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $userId=0;
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $nam=$data['nam'];
            $thang=$data['thang'];
            $timestamp = strtotime('2021-07-16');
            $day = date('l', $timestamp);
            $soNgay = cal_days_in_month(CAL_GREGORIAN, $thang, $nam);
            $view=view('TrangChu::danh-sach-lich-ca-nhan', compact('error','day'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }
}