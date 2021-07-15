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
        }else{ 
            return redirect()->route('to-do');
            return view('TrangChu::home');
        }
        
    }
}