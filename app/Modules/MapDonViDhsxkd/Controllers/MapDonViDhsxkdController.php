<?php
namespace App\Modules\MapDonViDhsxkd\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use App\BcMapDonViDhsxkd;
use App\BcDhsxkd;
use App\DonVi;
use Request as RequestAjax;


class MapDonViDhsxkdController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    public function mapDonViDhsxkd(Request $request){
        return view('MapDonViDhsxkd::map-don-vi-dhsxkd');
    }


    public function danhSachMapDonViDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $error=''; // Khai báo biến
            $danhSachMaps=BcMapDonViDhsxkd::select('bc_map_don_vi_dhsxkd.id','bc_map_don_vi_dhsxkd.id_don_vi','bc_map_don_vi_dhsxkd.id_don_vi_dhsxkd','bc_map_don_vi_dhsxkd.ten_don_vi_dhsxkd', 'bc_map_don_vi_dhsxkd.state', 'don_vi.ten_don_vi')
                ->leftJoin('don_vi','bc_map_don_vi_dhsxkd.id_don_vi','=','don_vi.id')
                ->get()->toArray();
            $view=view('MapDonViDhsxkd::danh-sach-map-don-vi-dhsxkd', compact('danhSachMaps','error'))->render(); // Trả dữ liệu ra view 
            return response()->json(['html'=>$view,'error'=>$error]); // Return dữ liệu ra ajax
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Trả về lỗi phương thức truyền số liệu
    }

    public function themMapDonViDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $data=RequestAjax::all(); // Lấy tất cả dữ liệu
            BcMapDonViDhsxkd::create($data); // Lưu dữ liệu vào DB
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    
    public function quetDonViLienThongDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            $dsDonViDhsxkd=BcDhsxkd::getDonViDhsxkd();
            // Kiểm tra danh sách này nếu cái nào chưa có trong DB thì insert
            foreach ($dsDonViDhsxkd as $key => $donViDhsxkd) {
                $checkDonViExits=BcMapDonViDhsxkd::where('id_don_vi_dhsxkd','=',$donViDhsxkd['donvi_id'])->where('state','=',1)->get()->toArray();
                if(count($checkDonViExits)<=0){
                    $dataDonViLienThongDhsxkd=array();
                    $dataDonViLienThongDhsxkd['id_don_vi_dhsxkd']=$donViDhsxkd['donvi_id'];
                    $dataDonViLienThongDhsxkd['ten_don_vi_dhsxkd']=$donViDhsxkd['ten_dv'];
                    $dataDonViLienThongDhsxkd['state']=1;
                    BcMapDonViDhsxkd::create($dataDonViLienThongDhsxkd);
                }
            }
            return array("error"=>''); // Trả về thông báo lưu dữ liệu thành công
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu"); // Báo lỗi phương thức truyền dữ liệu
    }

    public function mapDonViDhsxkdSingle(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra gửi đường ajax
            // Khai báo các dữ liệu bên form cần thiết
            $error='';
            $dataForm=RequestAjax::all(); $data=array();
            $donVis=DonVi::all()->toArray();
            // Kiểm tra dữ liệu không hợp lệ
            if(isset($dataForm['id'])){ // ngược lại dữ liệu hợp lệ
                $data = BcMapDonViDhsxkd::where("id","=",$dataForm['id'])->get(); // kiểm tra dữ liệu trong DB
                if(count($data)<1){ // Nếu dữ liệu ko tồn tại trong DB
                    $error="Không tìm thấy dữ liệu cần sửa";
                }else{ // ngược lại dữ liệu tồn tại trong DB
                    $data=$data[0];
                    $error="";
                }
            }            
            $view=view('MapDonViDhsxkd::map-don-vi-dhsxkd-single', compact('data','error', 'donVis'))->render(); // Trả dữ liệu ra view trước     
            return response()->json(['html'=>$view, 'error'=>$error]); // return dữ liệu về AJAX sau
        }
        return array('error'=>"Không tìm thấy phương thức truyền dữ liệu"); // return dữ liệu về AJAX
    }


    public function capNhatMapDonViDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $mapDonViSxkd=BcMapDonViDhsxkd::where("id","=",$id)->get()->toArray();
            if(count($mapDonViSxkd)==1){
                unset($dataForm["_token"]);
                $mapDonViSxkd=BcMapDonViDhsxkd::where("id","=",$id);
                $mapDonViSxkd->update($dataForm);
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần sửa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }

    public function xoaMapDonViDhsxkd(Request $request){
        if(RequestAjax::ajax()){ // Kiểm tra phương thức gửi dữ liệu là AJAX
            $dataForm=RequestAjax::all(); // Lấy tất cả dữ liệu đã gửi
            if(!isset($dataForm['id'])){ // Kiểm tra nếu ko tồn tại id hoặc ko được xóa mấy cái dữ liệu hệ thống
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }
            $id=$dataForm['id']; //ngược lại có id
            $mapDonViSxkd=BcMapDonViDhsxkd::where("id","=",$id)->get();
            if(count($mapDonViSxkd)==1){
                BcMapDonViDhsxkd::where("id","=",$id)->delete();
                return array("error"=>'');
            }else{
                return array("error"=>'Không tìm thấy dữ liệu cần xóa'); // Trả lỗi về AJAX
            }         
            
        }
        return array('error'=>"Lỗi phương thức truyền dữ liệu");
    }
    
}