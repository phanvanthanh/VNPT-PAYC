<?php
namespace App\Modules\SSO\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;
use App\SsoModel;
use App\User;

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
        //$this->middleware('guest');
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
                        Session::put('sso_login', 1);
                        return redirect()->route('/');
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
                        Session::put('sso_login', 1);
                        return redirect()->intended('/');
                    }
                    
                }

                
            }

        } 
        // Đăng nhập thất bại
        $request->session()->flash('notification-error', '<b>Đăng nhập thất bại</b>! '.$respone['message']);
        return redirect()->route('login');
        
    }


    public function ssoDangXuat(Request $request)
    {
        $ssoLogin = Session::get('sso_login');
        Auth::logout();        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if($ssoLogin==1){
            header('Location: https://portal.vnpttravinh.vn/');
            exit;
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