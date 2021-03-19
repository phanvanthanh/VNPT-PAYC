<?php
namespace App\Modules\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\DmThamSoHeThong;
use App\Http\Controllers\Controller;
class PassportAuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function apiTaoTaiKhoan(Request $request)
    {
        $request->validate([
            'secret_key'=>'required|string',
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $secretKey=DmThamSoHeThong::getValueByName('SECRET_KEY_API_TAO_TAI_KHOAN');
        if($request->secret_key!=$secretKey){
            return response()->json([
                'message'   => 'Tạo tài khoản thất bại.',
                "errors"     => [
                    "secret_key" => [
                        "Sercret key không hợp lệ"
                    ]
                ]
            ], 201);
        }
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Tạo tài khoản thành công!',
            "errors"     =>[]
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function apiDangNhap(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message'   => 'Unauthorized',
                'errors'    =>1
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'message'       => 'Đăng nhập thành công',
            'errors'        => 0,
            'access_token'  => $tokenResult->accessToken,
            'token_type'    => 'Bearer',
            'expires_at'    => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function apiDangXuat(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Đăng xuất thành công',
            'errors'        => 0
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function apiGetUser(Request $request)
    {
        return response()->json($request->user());
    }
}
?>