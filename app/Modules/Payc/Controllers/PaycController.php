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


    public function danhSachPaycDangXuLy(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycDangXuLy($userId);
            return view('Payc::danh-sach-payc-dang-xu-ly', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-dang-xu-ly', compact('paycs','error'));
    }  


    public function danhSachPaycDaChuyenLanhDaoDuyet(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycDaChuyenLanhDaoDuyet($userId);
            return view('Payc::danh-sach-payc-da-chuyen-lanh-dao-duyet', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-da-chuyen-lanh-dao-duyet', compact('paycs','error'));
    }  


    public function danhSachPaycDaChuyenLanhDaoKhacDuyet(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycDaChuyenLanhDaoKhacDuyet($userId);
            return view('Payc::danh-sach-payc-da-chuyen-lanh-dao-khac-duyet', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-da-chuyen-lanh-dao-khac-duyet', compact('paycs','error'));
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


    public function danhSachPaycDaDuyet(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycDaDuyet($userId);
            return view('Payc::danh-sach-payc-da-duyet', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-da-duyet', compact('paycs','error'));
    }  


    public function danhSachPaycTraLaiBuocTiepNhan(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycTraLaiBuocTiepNhan($userId);
            return view('Payc::danh-sach-payc-tra-lai-buoc-tiep-nhan', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-tra-lai-buoc-tiep-nhan', compact('paycs','error'));
    } 


    public function danhSachPaycTraLaiCanBoXuLy(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycTraLaiCanBoXuLy($userId);
            return view('Payc::danh-sach-payc-tra-lai-can-bo-xu-ly', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-tra-lai-can-bo-xu-ly', compact('paycs','error'));
    } 

    public function danhSachPaycDaHuy(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycDaHuy($userId);
            return view('Payc::danh-sach-payc-da-huy', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-da-huy', compact('paycs','error'));
    } 


    public function danhSachPaycChoKhachHangDanhGia(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycChoKhachHangDanhGia($userId);
            return view('Payc::danh-sach-payc-cho-khach-hang-danh-gia', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-cho-khach-hang-danh-gia', compact('paycs','error'));
    } 


    public function danhSachPaycChoLanhDaoDanhGia(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycChoLanhDaoDanhGia($userId);
            return view('Payc::danh-sach-payc-cho-lanh-dao-danh-gia', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-cho-lanh-dao-danh-gia', compact('paycs','error'));
    } 


    public function danhSachPaycChoCanBoDanhGia(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycChoCanBoDanhGia($userId);
            return view('Payc::danh-sach-payc-cho-can-bo-danh-gia', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-cho-can-bo-danh-gia', compact('paycs','error'));
    } 

    public function danhSachPaycChoCapNhat(Request $request){
        $userId=Auth::id();
        $error=''; // Khai báo biến
        $paycs=array();
        if($userId){
            $paycs=Payc::getDanhSachPaycChoCapNhat($userId);
            return view('Payc::danh-sach-payc-cho-cap-nhat', compact('paycs','error'));
        }
        $error='Vui lòng đăng nhập vào hệ thống';
        return view('Payc::danh-sach-payc-cho-cap-nhat', compact('paycs','error'));
    } 
}