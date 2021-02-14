<?php
namespace App\Modules\Payc\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp;
use Illuminate\Support\Facades\DB;
use App\DonVi;
use App\Payc;
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
        return view('Payc::payc');
    }

    public function danhSachPaycAnDanh(Request $request){
        $error=''; // Khai báo biến
        $paycs=Payc::where('id_user_tao','=',1)->get()->toArray();
        return view('Payc::danh-sach-payc-an-danh', compact('paycs','error'));
    }

    public function danhSachPaycCuaToi(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::where('id_user_tao','=',$userId)->get()->toArray();
            return view('Payc::danh-sach-payc-cua-toi', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-cua-toi', compact('paycs','error'));

        
    }    


    public function themPayc(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $userId=Auth::id();
            if(!$userId){
                $userId=1;
            }
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $data['id_user_tao']=$userId;
            if ($request->hasFile('file_payc')) {
                $data['file_payc']=\Helper::getAndStoreFile($request->file('file_payc'));
            }
            $data['han_xu_ly_mong_muon']=\Helper::toDatePayc($data['ngay'].' '.$data['gio'].':00');
            $data['id_users']=Auth::id();
            Payc::create($data); // Lưu dữ liệu vào DB
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

    public function danhSachPaycDaTiepNhan(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycDaTiepNhan($userId);
            return view('Payc::danh-sach-payc-da-tiep-nhan', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-da-tiep-nhan', compact('paycs','error'));
    }  

    public function danhSachPaycDaHoanTat(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycDaHoanTat($userId);
            return view('Payc::danh-sach-payc-da-hoan-tat', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-da-hoan-tat', compact('paycs','error'));
    }  

    public function danhSachPaycDaTuChoi(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycDaTuChoi($userId);
            return view('Payc::danh-sach-payc-da-tu-choi', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-da-tu-choi', compact('paycs','error'));
    } 

    public function danhSachPaycDaChuyenXuLy(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycDaChuyenXuLy($userId);
            return view('Payc::danh-sach-payc-da-chuyen-xu-ly', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-da-chuyen-xu-ly', compact('paycs','error'));
    }  
}