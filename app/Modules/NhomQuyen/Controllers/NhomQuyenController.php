<?php
namespace App\Modules\NhomQuyen\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\AdminRole;
use App\AdminResource;
use App\DonVi;
use Request as RequestAjax;


class NhomQuyenController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function nhomQuyen(Request $request){
        $roles = AdminRole::all();
        $donVis=DonVi::where('don_vi.state','=',1)->get()->toArray();
        $donVis=\Helper::paycTreeResource($donVis,null);
        return view('NhomQuyen::nhom-quyen',compact('roles', 'donVis'));
    }


    public function danhSachNhomQuyen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $roles = AdminRole::select('admin_role.id', 'admin_role.role_name','admin_role.id_don_vi','admin_role.state','don_vi.ten_don_vi')
            ->leftJoin('don_vi','admin_role.id_don_vi','don_vi.id')
            ->get()->toArray(); // điều kiện nhóm quyền còn hoạt động
            $view=view('NhomQuyen::danh-sach-nhom-quyen', compact('roles','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themNhomQuyen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            AdminRole::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function layNhomQuyenTheoId(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            $donVis=DonVi::where('don_vi.state','=',1)->get()->toArray();
            $donVis=\Helper::paycTreeResource($donVis,null);
            // Kiểm tra dữ liệu không hợp lệ
            if(!isset($dataForm['id'])){
                $error="Không tìm thấy dữ liệu cần chỉnh sửa";
            }else{ // ngược lại dữ liệu hợp lệ
                $data = AdminRole::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('NhomQuyen::nhom-quyen-single', compact('data','donVis','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatNhomQuyen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $adminRole=AdminRole::where("id","=",$id)->get()->toArray();
            if(count($adminRole)==1){
                unset($dataForm["_token"]);
                $adminRole=AdminRole::where("id","=",$id);
                $adminRole->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaNhomQuyen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $taiNguyen=AdminRole::where("id","=",$id)->get();
            if(count($taiNguyen)==1){
                AdminRole::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
    
}