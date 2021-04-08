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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\UsersDonVi;
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
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            User::create([
                'name' => $request->hoten,
                'email' => $request->email,
                //'password' => bcrypt($request->matkhau),
                'password' => Hash::make($request->matkhau),
                'password' => bcrypt($request->matkhau),
                'api_token' => Str::random(60),
                'di_dong' => $request->sdt,
                'loai_tai_khoan' => 'CAN_BO',
                'state' => $request->state
            ]); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function userSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            $users=User::where('state','=',1)->get()->toArray();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = User::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('User::user-single', compact('data','users','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatUser(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $user=User::where("id","=",$id)->get()->toArray();
            if(count($user)==1){
                // unset($user["_token"]);
                // $user=User::where("id","=",$id);
                // $user->update($dataForm);
                $user=User::find($id);
                $user->name = $request->hoten;
                $user->email = $request->email;
                $user->password = bcrypt($request->matkhau);
                $user->di_dong = $request->sdt;
                $user->state = $request->state;
                $user->save();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }             
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaUser(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id']) || $dataForm['id']==1 || $dataForm['id']==2){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $user=User::where("id","=",$id)->get();
            if(count($user)==1){
                User::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
 
    public function userDonViSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            $users=User::where('state','=',1)->get()->toArray();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = User::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('User::user-don-vi-single', compact('data','users','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function luuUserDonVi(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $UsersDonVi = new UsersDonVi();
            $UsersDonVi->id_don_vi = $request->idDonVi;
            $UsersDonVi->id_user = $request->idUser;
            $UsersDonVi->id_chuc_danh = $request->chucDanh;
            $UsersDonVi->id_chuc_vu = $request->chucVu;
            $UsersDonVi->ngay_bat_dau_cong_tac = $request->ngayBatDau;
            $UsersDonVi->ngay_ket_thuc_cong_tac = $request->ngayKetThuc;
            $UsersDonVi->state = $request->state;
            $UsersDonVi->save();
            return 1;
            // $view=view('User::user-donvi', compact('data','users','error'))->render(); // Trả dữ liệu ra view trước     
            // return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function loadDsUserDonvi(Request $request){
        $idUser = $request->idUser;
        return view('User::danh-sach-user-donvi', compact('idUser'));
    }
    public function xoaUserDonVi(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            UsersDonVi::find($data['idUserDonVi'])->delete();
            return 1;
            // return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }


    public function userRoleSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            $users=User::where('state','=',1)->get()->toArray();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = User::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('User::user-role-single', compact('data','users','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }
}