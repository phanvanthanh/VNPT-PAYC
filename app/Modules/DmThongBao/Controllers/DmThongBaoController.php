<?php
namespace App\Modules\DmThongBao\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\AdminRole;
use App\AdminResource;
use App\DonVi;
use App\DichVu;
use App\NhomDichVu;
use App\DmThongBao;
use App\DmThongBaoUsers;
use App\User;
use App\Helpers\Helper;
use Request as RequestAjax;


class DmThongBaoController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function dmThongBao(Request $request){
        return view('DmThongBao::dm-thong-bao');
    }


    public function danhSachDmThongBao(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $dmThongBaos=DmThongBao::all()->toArray();
            $view=view('DmThongBao::danh-sach-dm-thong-bao', compact('dmThongBaos','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themDmThongBao(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ 
            $userId=1;
            if(Auth::id()){
                $userId=Auth::id();
            }
            $data['id_user_tao']=$userId;
            $dmThongBao=DmThongBao::create($data); // Lưu dữ liệu vào DB
            $idThongBao=$dmThongBao->id;
            $users=User::all()->toArray();
            foreach ($users as $key => $user) {
                $dataThongBaoUsers=array();
                $dataThongBaoUsers['id_user']=$user['id'];
                $dataThongBaoUsers['id_thong_bao']=$idThongBao;
                $dataThongBaoUsers['is_da_xem']=0;
                DmThongBaoUsers::create($dataThongBaoUsers);
            }

            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function dmThongBaoSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = DmThongBao::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('DmThongBao::dm-thong-bao-single', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatDmThongBao(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $dmThongBao=DmThongBao::where("id","=",$id)->get()->toArray();
            if(count($dmThongBao)==1){
                unset($dataForm["_token"]);
                $dmThongBao=DmThongBao::where("id","=",$id);
                $dmThongBao->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaDmThongBao(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $dmThongBao=DmThongBao::where("id","=",$id)->get();
            if(count($dmThongBao)==1){
                DmThongBao::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function daXemThongBao(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            $userId=1;
            if(Auth::id()){
                $userId=Auth::id();
            }
            DmThongBaoUsers::where('id_user','=',$userId)->where('is_da_xem','=',0)->update(['is_da_xem'=>1]);
            $soTbConLai=Helper::kiemTraSoLuongThongBaoConLai($userId);
            return array('error'=>"", 'so_tb_con_lai'=>$soTbConLai);
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
    
}