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
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\UsersRole;
use App\DichVu;
use App\UsersDichVu;
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
            $users=User::where('loai_tai_khoan','=','CAN_BO')->get()->toArray();
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
            $roles = AdminRole::layDanhSachNhomQuyen();
            $idUser=$dataForm['id'];
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = UsersRole::layDanhSachNhomQuyenTheoUserId($dataForm['id']); // kiểm tra dữ liệu trong DB
            }            
            $view=view('User::user-role-single', compact('data','roles','error', 'idUser'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    public function phanQuyenUserRole(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['role_id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Bạn chưa chọn nhóm quyền'); // Trả lỗi về AJAX
            }
            if(!isset($dataForm['user_id']) || $dataForm['user_id']==1){ // Kiểm tra nếu ko tồn tại id hoặc user id =1 không cho xóa vãng lai
                return array("error"=>'Bạn chưa chọn tài khoản cần phân quyền'); // Trả lỗi về AJAX
            }
            $roleId=$dataForm['role_id']; //ngược lại có role id
            $userId=$dataForm['user_id']; //ngược lại có resource id
            // kiểm tra đã có quyền này chưa
            $checkUserRole=UsersRole::select('id')->where('role_id','=',$roleId)->where('user_id','=',$userId)->get()->toArray();
            $resources=AdminResource::all()->toArray();
            // thực hiện xóa quyền nếu đã có
            if(count($checkUserRole)>0){
                // Xóa quyền đó
                $userRole=UsersRole::select('id')->where('role_id','=',$roleId)->where('user_id','=',$userId)->delete();
            }else{
                $data['role_id']=$roleId;
                $data['user_id']=$userId;
                // Thêm quyền đó
                $userRole=UsersRole::create($data); 
            }
            // thực hiện thêm quyền nếu chưa có
            return array('error'=>"");
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }



    public function thongTinCaNhan(Request $request){
        $error=''; $data=array();
        if(Auth::id()){
            $id=Auth::id();
            $user=User::where('id','=',$id)->get()->toArray();
            if($user){
                $data=$user[0];
                return view('User::thong-tin-ca-nhan',compact('error', 'data'));
            }
        }
        return view('User::thong-tin-ca-nhan',compact('error', 'data'));
        
    }


    public function capNhatThongTinCaNhan(Request $request){
        $error='Cập nhật tài khoản thất bại'; $data=array();
        if(Auth::id()){
            $id=Auth::id();
            // Validatetor
            $this->validator($request->all())->validate();
            // Kiểm tra thông tin gửi với tài khoản đang login có khớp không

            $user=User::where('id','=',$id)->where('email','=',$request->email)->get()->toArray();
            if(!$user){
                $request->session()->flash('notification-error', 'Lỗi! Tài khoản cập nhật không hợp lệ.');
                return redirect()->route('thong-tin-ca-nhan');
            }
            $user=User::find($id);
            if($request->old_password){
                $hashedPassword=$user->password;
                if(Hash::check($request->old_password, $hashedPassword)){
                    $user->password=bcrypt($request->password);
                }else{
                    $request->session()->flash('notification-error', 'Mật khẩu xác thực không đúng.');
                    return redirect()->route('thong-tin-ca-nhan');
                }
            }            
            $user->name=$request->name;
            $user->di_dong=$request->di_dong;
            // Lấy hình ảnh
            if ($request->hasFile('hinh_anh')) {
                $hinhAnh=\Helper::getAndStoreFile($request->file('hinh_anh'));
                $hinhAnh=explode(';', $hinhAnh);
                if(count($hinhAnh)>0){
                    $user->hinh_anh=$hinhAnh[0];
                }
            }
            $user->update();
            $request->session()->flash('notification-success', 'Chúc mừng! Bạn đã <b>cập nhật thông tin tài khoản thành công</b>.');
            return redirect()->route('thong-tin-ca-nhan');
        }
        return redirect()->route('thong-tin-ca-nhan');
        
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
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'max:255', 'email', 'exists:users'],
            'old_password'      => ['nullable', 'string', 'min:6'],
            'password'          => ['nullable', 'string', 'min:6', 'same:password_confirm'],
            'password_confirm'  => ['nullable', 'string', 'min:6'],
        ]);
    }


    public function userDichVuSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array(); $userId=0;
            $dichVus=DichVu::where('state','=',1)->get()->toArray();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $userId=$dataForm['id'];
            }            
            $view=view('User::user-dich-vu-single', compact('userId','dichVus','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }

    
    public function danhSachDichVuTheoTaiKhoan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $dataForm=RequestAjax::all();
            $error=''; // Khai báo biến
            $dichVus=array();
            $userId=0;
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $userId=$dataForm['id'];
                $dichVus=UsersDichVu::danhSachDichVuTheoTaiKhoan($userId);
            } 
            $view=view('User::danh-sach-dich-vu-theo-tai-khoan', compact('dichVus','error', 'userId'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themUserDichVu(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            
            UsersDichVu::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function xoaUserDichVu(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id, không xóa vnpt và viễn thông tỉnh
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $donVi=UsersDichVu::where("id","=",$id)->get();
            if(count($donVi)==1){
                UsersDichVu::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
}