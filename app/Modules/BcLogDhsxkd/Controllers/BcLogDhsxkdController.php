<?php
namespace App\Modules\BcLogDhsxkd\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\BcLogDhsxkd;
use App\DichVu;
use Request as RequestAjax;


class BcLogDhsxkdController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function BcLogDhsxkd(Request $request){
        return view('BcLogDhsxkd::bc-log-dhsxkd');
    }


    public function danhSachBcLogDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $logs=BcLogDhsxkd::select('bc_log_dhsxkd.id','bc_log_dhsxkd.user_id', 'users.email', 'users.name', 'bc_log_dhsxkd.send_body', 'bc_log_dhsxkd.respone_body', 'bc_log_dhsxkd.created_at')
            ->leftJoin('users','bc_log_dhsxkd.user_id','=','users.id')
            ->get()->toArray();
            $view=view('BcLogDhsxkd::danh-sach-bc-log-dhsxkd', compact('logs','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    
    
}