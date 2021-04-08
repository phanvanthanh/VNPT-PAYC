<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;
use DB;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\UsersRole;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'same:password_confirm'],
            'password_confirm' => ['required', 'string', 'min:6'],
        ]);
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $data=$request->all();
        $data['loai_tai_khoan']='KHACH_HANG';
        $data['hinh_anh']='';
        if ($request->hasFile('hinh_anh')) {
            $hinhAnh=\Helper::getAndStoreFile($request->file('hinh_anh'));
            $hinhAnh=explode(';', $hinhAnh);
            if(count($hinhAnh)>0){
                $data['hinh_anh']=$hinhAnh[0];
            }
        }
        event(new Registered($user = $this->create($data)));

        $dataUserRole=array(
            'user_id'=>$user->id,
            'role_id'=>1
        );
        $userRole=UsersRole::create($dataUserRole);
        //$this->guard()->login($user);
        $success='Đăng ký tài khoản thành công';
        $request->session()->flash('notification', 'Chúc mừng! Bạn đã <b>tạo tài khoản thành công</b>.');
        return redirect()->route('register');
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => Str::random(60),
            'di_dong' => $data['di_dong'],
            'hinh_anh' => $data['hinh_anh'],
            'loai_tai_khoan' => 'CAN_BO',
            'state' => 1
        ]);
    }
}

