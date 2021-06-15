<?php
namespace App\Modules\DmTuan\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\BcDmChiSo;
use App\BcDmTuan;
use Request as RequestAjax;
use DateTime;
use App\BcDmThoiGianBaoCao;


class DmTuanController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function dmTuan(Request $request){
        $dmTuans=BcDmTuan::all()->toArray();
        return view('DmTuan::dm-tuan', compact('dmTuans'));
    }


    public function danhSachDmTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $dmTuans=BcDmTuan::all()->toArray();
            $view=view('DmTuan::danh-sach-dm-tuan', compact('dmTuans','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themDmTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            BcDmTuan::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function themDmTuanHangLoat(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $maxNam=BcDmTuan::max('nam');
            if(!$maxNam)
                $maxNam=2020;
            $maxNam++;
            for ($y=$maxNam; $y < $maxNam+10; $y++) {
                $date = new DateTime;
                $date->setISODate($y, 53);
                $maxWeek=$date->format("W") === "53" ? 53 : 52;
                for ($w=1; $w < $maxWeek+1; $w++) { 
                    $dateOfWeek=BcDmThoiGianBaoCao::getStartAndEndDateOfWeek($y, $w);
                    $dataDmTuan=array();
                    $dataDmTuan['tu_ngay']=$dateOfWeek[0];
                    $dataDmTuan['den_ngay']=$dateOfWeek[1];
                    $dataDmTuan['nam']=$y;
                    $dataDmTuan['thang']=null;
                    $dataDmTuan['tuan']=$w;
                    $dataDmTuan['trang_thai']=1;
                    BcDmTuan::create($dataDmTuan);
                }
                    
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function dmTuanSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = BcDmTuan::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('DmTuan::dm-tuan-single', compact('data','error'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatDmTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $dmTuans=BcDmTuan::where("id","=",$id)->get()->toArray();
            if(count($dmTuans)==1){
                unset($dataForm["_token"]);
                $dmTuans=BcDmTuan::where("id","=",$id);
                $dmTuans->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaDmTuan(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $dmTuan=BcDmTuan::where("id","=",$id)->get();
            if(count($dmTuan)==1){
                BcDmTuan::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
    
}