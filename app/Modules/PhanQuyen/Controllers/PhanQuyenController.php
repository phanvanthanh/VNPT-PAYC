<?php
namespace App\Modules\PhanQuyen\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\AdminRule;
use App\AdminRole;
use App\AdminResource;
use Request as RequestAjax;


class PhanQuyenController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }
    
    public function phanQuyen(Request $request){
        $roles = AdminRole::where('state','=',1)->get()->toArray();
        $resources = AdminResource::where('status','=',1)->where('id','!=',1)->where('parent_id','=',1)->where('show_menu','=',1)->orderBy('order')->get()->toArray();
        return view('PhanQuyen::phan-quyen',compact('roles','resources'));
    }

    public function phanQuyenDanhSachNhomQuyen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $roles = AdminRole::select('admin_role.id', 'admin_role.role_name','admin_role.id_don_vi','admin_role.state','don_vi.ten_don_vi')
            ->leftJoin('don_vi','admin_role.id_don_vi','don_vi.id')
            ->where('admin_role.state','=',1)
            ->get()->toArray(); // điều kiện nhóm quyền còn hoạt động
            $view=view('PhanQuyen::danh-sach-nhom-quyen', compact('roles','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function phanQuyenDanhSachQuyenTheoNhomQuyenId(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $rules=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(!isset($dataForm['id']) || $dataForm['id']==null || $dataForm['id']=='' || $dataForm['id']==0){
                $rules=array();
            }else{ // ngược lại dữ liệu hợp lệ
                $data = AdminRule::where("role_id","=",$dataForm['id'])->get()->toArray(); // kiểm tra dữ liệu trong DB
                $rules=array();
                foreach ($data as $key => $rule) {
                    $rules[$rule['resource_id']]=$rule; // set lại key cho rules để ra view dễ check chỗ checkbox
                }
            }          
            $resources = AdminResource::where('id','!=',1)->where('status','=',1)->where('parent_id','=',1)->where('show_menu','=',1)->orderBy('order')->get()->toArray();
            $view=view('PhanQuyen::danh-sach-quyen-theo-nhom-quyen-id', compact('rules','resources','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function phanQuyenPost(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['role_id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Bạn chưa chọn nhóm quyền'); // Trả lỗi về AJAX
            }
            if(!isset($dataForm['resource_id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Bạn chưa chọn quyền'); // Trả lỗi về AJAX
            }
            $roleId=$dataForm['role_id']; //ngược lại có role id
            $resourceId=$dataForm['resource_id']; //ngược lại có resource id
            // kiểm tra đã có quyền này chưa
            $checkRule=AdminRule::select('id')->where('role_id','=',$roleId)->where('resource_id','=',$resourceId)->get()->toArray();
            // thực hiện xóa quyền nếu đã có
            if(count($checkRule)>0){
                // Xóa quyền đó
                $rule=AdminRule::where('role_id','=',$roleId)->where('resource_id','=',$resourceId)->delete();
                // Xóa các quyền con của quyền đó
                $childResources=AdminResource::select('id')->where('parent_id','=',$resourceId)->get()->toArray();
                foreach ($childResources as $key => $childResources) {
                    $rule=AdminRule::where('role_id','=',$roleId)->where('resource_id','=',$childResources['id'])->delete();
                }
            }else{
                $data['role_id']=$roleId;
                $data['resource_id']=$resourceId;
                // Thêm quyền đó
                $rule=AdminRule::create($data); 
                // Thêm các quyền con của quyền đó
                $childResources=AdminResource::select('id')->where('parent_id','=',$resourceId)->get()->toArray();
                foreach ($childResources as $key => $childResources) {
                    $data['resource_id']=$childResources['id'];
                    $rule=AdminRule::create($data);
                }

            }
            // thực hiện thêm quyền nếu chưa có

            return array('error'=>"");
                   
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    
}