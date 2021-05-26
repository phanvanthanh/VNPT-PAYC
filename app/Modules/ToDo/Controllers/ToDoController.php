<?php
namespace App\Modules\ToDo\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\AdminRole;
use App\AdminResource;
use App\DonVi;
use App\ToDo;
use Request as RequestAjax;


class ToDoController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function toDo(Request $request){
        return view('ToDo::to-do');
    }


    public function danhSachToDo(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến

            $toDos=ToDo::orderBy('sap_xep', 'asc')->get()->toArray();
            $view=view('ToDo::danh-sach-to-do', compact('toDos','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themToDo(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            $data['id_user']=Auth::id();
            if($data['noi_dung']==''){
                return array('error'=>"Thông tin nhập vào chưa đủ");
            }
            ToDo::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function toDoSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = ToDo::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('ToDo::to-do-single', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatToDo(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $toDo=ToDo::where("id","=",$id)->get()->toArray();
            if(count($toDo)==1){
                unset($dataForm["_token"]);
                $toDo=ToDo::where("id","=",$id);
                $toDo->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaToDo(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id']) || $dataForm['id']==1){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $toDo=ToDo::where("id","=",$id)->get();
            if(count($toDo)==1){
                ToDo::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function checkToDo(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $id = $request->input('id');
            $toDo = ToDo::find($id);
            $toDo->ngay_hoan_thanh = date("Y-m-d H:i:s");
            $toDo->save();
            return 1;
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function uncheckToDo(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $id = $request->input('id');
            $toDo = ToDo::find($id);
            $toDo->ngay_hoan_thanh = null;
            $toDo->save();
            return 1;
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function sortToDo(Request $request){
        $dsId = $request->input('dsId');
        $arr_id = explode(';', $dsId);
        $toDo = ToDo::all();
        $soLuongToDo = $toDo->count();
        $j=1;
        for($i=0; $i<$soLuongToDo; $i++){
            $td = ToDo::find($arr_id[$i]);
            $td->sap_xep = $j;
            $td->save();
            $j++;
        }
        return 1;
    }
}