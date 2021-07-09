<?php
namespace App\Modules\SSO\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use App\SsoModel;
use App\User;
use Firebase\JWT\JWT;

class SsoController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function ssoDangNhap(Request $request)
    {
        $username=$request->email;
        $password=base64_encode($request->password);            
        $respone=SsoModel::ssoDangNhap($username, $password);

        if($respone['errors']==0 && isset($respone['data']['success']) && $respone['data']['success']==1){ // Đăng nhập thành công
            $userSso=$respone['data']['user'];
            // Gọi tiếp API lấy ID nhân viên
            $accessToken=$respone['data']['access-token'];
            $responeNhanViens=SsoModel::ssolayIdNhanVien($accessToken);
            if($responeNhanViens['errors']==0 && isset($responeNhanViens['data']['message'])){ // Đăng nhập thành công
                $idNhanVien=base64_decode($responeNhanViens['data']['message']);
                

                // Kiểm tra trong bảng của mình nếu chưa có user này thì lưu vô
                $checkUserExits=User::where('sso_nhanvien_id','=',$idNhanVien)->get()->toArray();                
                $passwordBcrypt=bcrypt($request->password);
                
                if(count($checkUserExits)<1){
                    $user = new User([
                        'name'          => $userSso['ten_nd'],
                        'email'         => $userSso['ma_nd'],
                        'password'      => $passwordBcrypt,
                        'loai_tai_khoan'=>'CAN_BO',
                        'di_dong'       => $userSso['sdt'],
                        'sso_nhanvien_id'   => $idNhanVien,
                        'sso_password'   => $password
                    ]);
                    $user->save();

                    // Đăng nhập vào hệ thống bằng tài khoản đã nhập
                    $credentials = $request->only('email', 'password');
                    if (Auth::attempt($credentials)) {                        
                        return redirect()->intended('to-do');
                    }
                }else{
                    // Cập nhật lại một số thông tin
                    User::where('sso_nhanvien_id','=',$idNhanVien)->update([
                        'name'          => $userSso['ten_nd'],
                        'di_dong'       => $userSso['sdt'],
                        'sso_password'   => $password
                    ]);
                    $userId=$checkUserExits[0]['id'];
                    // Đăng nhập bằng user id
                    if (Auth::loginUsingId($userId)) {
                        return redirect()->intended('to-do');
                    }
                    
                }

                
            }

        } 
        // Đăng nhập thất bại
        $request->session()->flash('notification-error', '<b>Đăng nhập thất bại</b>! '.$respone['message']);
        return redirect()->route('login');
        
    }


    public function ssoDangNhap2(Request $request)
    {
       
        JWT::$leeway += 600;
        if ((isset($request->token))) {
            $ma_bao_mat = "vnpt-dntt";
            try {
                $token=$request->token;
                echo '<pre>';
                $ip = $this->getIPAddress();  
                echo 'User Real IP Address - '.$ip.'<br>'; 
                echo $request->token.'<br>';
                //print_r($token_decode);
                die();
                $token_decode = JWT::decode($request->token, $ma_bao_mat, ['HS256']);
                
                $base64IdNhanVien = $token_decode->nhanvien_id;
                $idNhanVien=base64_decode($base64IdNhanVien);
                // Lấy user để đăng nhập bên hệ thống mình
                $checkUserExits=User::where('sso_nhanvien_id','=',$idNhanVien)->get()->toArray();  

                if(count($checkUserExits)>0){
                    $userId=$checkUserExits[0]['id'];
                    // Đăng nhập bằng user id
                    if (Auth::loginUsingId($userId)) {
                        return redirect()->intended('to-do');
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
    }


    public static function getIPAddress() {  
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                    $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
    //whether ip is from the remote address  
        else{  
                 $ip = $_SERVER['REMOTE_ADDR'];  
         }  
         return $ip;  
    }  

}