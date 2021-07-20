<?php
namespace App\Modules\DmLinkQuanTri\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\DmLinkQuanTri;
use App\UsersDichVu;
use App\DmThongBao;
use App\User;
use Request as RequestAjax;


class DmLinkQuanTriController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function DmLinkQuanTri(Request $request){
        return view('DmLinkQuanTri::dm-link-quan-tri');
    }


    public function danhSachDmLinkQuanTri(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $idUser= Auth::id() ? Auth::id() : 0;
            $dichVus=UsersDichVu::select('dich_vu.id', 'dich_vu.ten_dich_vu')
                ->leftJoin('dich_vu','users_dich_vu.id_dich_vu','=','dich_vu.id')
                ->where('users_dich_vu.id_user','=',$idUser)
                ->get()->toArray();
            $view=view('DmLinkQuanTri::danh-sach-dm-link-quan-tri', compact('dichVus','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themDmLinkQuanTri(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ 
            $idUser= Auth::id() ? Auth::id() : 0;
            $data['id_user']=$idUser;
            DmLinkQuanTri::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function dmLinkQuanTriSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $idUser= Auth::id() ? Auth::id() : 0;
            $dataForm=RequestAjax::all(); $data=array();
            $dichVus=UsersDichVu::select('dich_vu.id', 'dich_vu.ten_dich_vu')
                ->leftJoin('dich_vu','users_dich_vu.id_dich_vu','=','dich_vu.id')
                ->where('users_dich_vu.id_user','=',$idUser)
                ->get()->toArray();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = DmLinkQuanTri::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('DmLinkQuanTri::dm-link-quan-tri-single', compact('data','error', 'dichVus'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatDmLinkQuanTri(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $dmLinkQuanTri=DmLinkQuanTri::where("id","=",$id)->get()->toArray();
            if(count($dmLinkQuanTri)==1){
                unset($dataForm["_token"]);
                $dmLinkQuanTri=DmLinkQuanTri::where("id","=",$id);
                $dmLinkQuanTri->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaDmLinkQuanTri(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $dmLinkQuanTri=DmLinkQuanTri::where("id","=",$id)->get();
            if(count($dmLinkQuanTri)==1){
                DmLinkQuanTri::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

  
    
}