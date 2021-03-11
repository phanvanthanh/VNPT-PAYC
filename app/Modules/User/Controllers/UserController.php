<?php
namespace App\Modules\User\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\AdminRole;
use App\AdminResource;
use App\User;
use Request as RequestAjax;


class UserController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function user(Request $request){
        $users=User::where('state','=',1)->get()->toArray();
        // $users=\Helper::paycTreeResource($users,null);
        return view('User::user',compact('users'));
    }


    public function danhSachUser(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $users=User::all()->toArray();
            $view=view('User::danh-sach-user', compact('users','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themUser(Request $request){
        // if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
        //     $data=RequestAjax::all(); // Lấy tất cả dữ liệu
        //     AdminRole::create($data); // Lưu dữ liệu vào DB
        //     return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        // }
        // return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function userSingle(Request $request){
        // if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
        //     // Khai báo các dữ liệu bên form cần thiết
        //     $error='';
        //     $dataForm=RequestAjax::all(); $data=array();
        //     $donVis=DonVi::where('don_vi.state','=',1)->get()->toArray();
        //     $donVis=\Helper::paycTreeResource($donVis,null);
        //     // Kiểm tra dữ liệu không hợp lệ
        //     if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
        //         $data = AdminRole::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
        //         if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
        //             $error="Không tìm thấy dữ liệu cần sửa";
        //         }else{ // ngược lại dữ liệu tồn tại trong DB
        //             $data=$data[0];
        //             $error="";
        //         }
        //     }            
        //     $view=view('NhomQuyen::nhom-quyen-single', compact('data','donVis','error'))->render(); // Trả dữ liệu ra view trước     
        //     return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        // }
        // return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatUser(Request $request){
        // if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
        //     $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
        //     if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
        //         return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
        //     }
        //     $id=$dataForm['id']; //ngược lại có id
        //     $adminRole=AdminRole::where("id","=",$id)->get()->toArray();
        //     if(count($adminRole)==1){
        //         unset($dataForm["_token"]);
        //         $adminRole=AdminRole::where("id","=",$id);
        //         $adminRole->update($dataForm);
        //         return array("error"=>'');
        //     }else{
        //         return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
        //     }         
            
        // }
        // return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaUser(Request $request){
        // if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
        //     $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
        //     if(!isset($dataForm['id']) || $dataForm['id']==1 || $dataForm['id']==2){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
        //         return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
        //     }
        //     $id=$dataForm['id']; //ngược lại có id
        //     $taiNguyen=AdminRole::where("id","=",$id)->get();
        //     if(count($taiNguyen)==1){
        //         AdminRole::where("id","=",$id)->delete();
        //         return array("error"=>'');
        //     }else{
        //         return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
        //     }         
            
        // }
        // return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
    
}