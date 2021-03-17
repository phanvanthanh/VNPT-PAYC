<?php
namespace App\Modules\TaiNguyen\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\AdminResource;
use App\AdminRule;
use Request as RequestAjax;


class TaiNguyenController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }
    /*
    * View Module TaiNguyen => tai-nguyen.balde.php
    */

    public function taiNguyen(Request $request){
       
        $resources = AdminResource::where("parent_id","=",1)->get(); // Lấy dữ liệu cần thiết        
        return view('TaiNguyen::tai-nguyen',compact('resources')); // Trả dữ liệu cần thiết ra view
    }

    public function danhSachTaiNguyen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến

            $resources = AdminResource::orderBy('order')->get()->toArray();
            $resources=\Helper::paycTreeResource($resources,null);
            $view=view('TaiNguyen::danh-sach-tai-nguyen', compact('resources','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }



    public function quetTaiNguyen(Request $request){
        // Kiểm tra menu mặc định đã có hay chưa
        $adminResourceDefault=AdminResource::where("id","=",1)->get();
        if(count($adminResourceDefault)<1){
            $adminResourceDefault=new AdminResource();
            $adminResourceDefault->id= 1;
            $adminResourceDefault->ten_hien_thi= 'Root';
            $adminResourceDefault->resource= '#';
            $adminResourceDefault->method= '#';
            $adminResourceDefault->action= '#';
            $adminResourceDefault->uri= '#';
            $adminResourceDefault->order= 0;
            $adminResourceDefault->ten_hien_thi = '#';
            $adminResourceDefault->show_menu= 1;
            $adminResourceDefault->parameter       = '#';
            $adminResourceDefault->parameter_value = '#';
            $adminResourceDefault->status = 1;
            $adminResourceDefault->parent_id = null;
            $adminResourceDefault->save();
            $adminResourceDefault->parent_id=1;
            $adminResourceDefault->save();
        }
        // cập nhật lại trạng thái resource về 0
        $allResource = AdminResource::where('status', '=', '1')->where('uri','!=','#')->get();
        foreach($allResource as $row) {
            $row->status = 0;
            $row->save();
        }
        $routeCollection = Route::getRoutes();
        $stt=0;
        foreach ($routeCollection as $value) {   
            // Điều kiện để xác định một resource đã tồn tại
            $method=$value->methods(); $method=$method[0];
            $action=$value->getActionName();
            $action2=explode("\\", $action);
            $arrayParrameterName=$value->parameterNames();
            if($action!='Closure' && $action2[0]!="Facade"){
                $stt++;
                // kiểm tra dữ liệu trong bảng AdminResource theo điều kiện
                $adminResourceExist=AdminResource::where('method',$method)->where('action',$action)->where('status',0)->get();
                $adminResourceExist1=$adminResourceExist;
                $adminResourceExist=$adminResourceExist->toArray();
                // nếu chưa tồn tại resource thì tạo mới
                if(!isset($adminResourceExist[0]['id'])){
                    // Đối tượng AdminResource
                    $adminResource=new AdminResource();
                    $adminResource->ten_hien_thi        = '';
                    $adminResource->resource        = $method.' | '.$action;
                    $adminResource->method          = $method;
                    $adminResource->action          = $action;
                    $adminResource->uri          = $value->uri();
                    $adminResource->order          = 1000;
                    $adminResource->ten_hien_thi          = $value->uri();
                    $showMenu=2;
                    if($method=='GET'){
                        $showMenu=1;
                    }

                    $adminResource->show_menu          = $showMenu;
                    $parameterName='';
                    $parameterValue='';
                    if(count($arrayParrameterName)>0 && isset($arrayParrameterName[0]) && $arrayParrameterName[0]!='resource' && $arrayParrameterName[0]!='token'){
                        foreach ($arrayParrameterName as $key => $prmt) {
                            if($key==0){
                                $parameterName='';
                                $parameterValue='';
                            }
                            else{
                                $parameterName.='';
                                $parameterValue.='';
                            }
                        }
                    }
                    $adminResource->parameter       = $parameterName;
                    $adminResource->parameter_value = $parameterValue;
                    $adminResource->status = 1;
                    $adminResource->parent_id = 1;

                    // phải sửa khúc này
                    $strUri=$value->uri();
                    $arrUri=explode('/', $strUri);
                    $adminResource->save();
                }
                else{
                    foreach ($adminResourceExist1 as $key => $exist) {
                        $exist->status=1;
                        $exist->uri          = $value->uri();
                        
                        if($exist->ten_hien_thi==''){
                            $exist->ten_hien_thi=$value->uri();
                        }

                        
                        $strUri=$value->uri();
                        $arrUri=explode('/', $strUri);
                        


                        $exist->parameter       = '';
                        $exist->parameter_value = '';
                        $exist->save();
                    }
                }
            }               
        }

        // Xóa bỏ những quyền rác
        $allResourceDelete = AdminResource::where('status', '=', '0')->get();
        foreach($allResourceDelete as $row) {
            // delete rule
            $rule=AdminRule::where('resource_id','=',$row->id);
            $rule->delete();
            $row->delete();
        }
        return redirect(route("tai-nguyen"));
    }

    public function themTaiNguyen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            AdminResource::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function taiNguyenSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            //$resources = AdminResource::all();
            $resources = AdminResource::orderBy('order')->get()->toArray();
            $resources=\Helper::paycTreeResource($resources,null);
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = AdminResource::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('TaiNguyen::tai-nguyen-single', compact('data','resources','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatTaiNguyen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $taiNguyen=AdminResource::where("id","=",$id)->get();
            if(count($taiNguyen)==1){
                unset($dataForm["_token"]);
                $taiNguyen=AdminResource::where("id","=",$id);
                $taiNguyen->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaTaiNguyen(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id']) || $dataForm['id']==1){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $taiNguyen=AdminResource::where("id","=",$id)->get();
            if(count($taiNguyen)==1){
                AdminResource::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
}