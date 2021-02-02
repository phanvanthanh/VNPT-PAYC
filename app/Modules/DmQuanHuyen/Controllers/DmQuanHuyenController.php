<?php
namespace App\Modules\DmQuanHuyen\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Modules\DmQuanHuyen\Models\ReadFileExcelDmQuanHuyen;
use App\DmQuanHuyen;



class DmQuanHuyenController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    /*
     * View load dữ liệu THÔNG TIN QUẬN HUYÊN 
     * Đọc từ cơ sở dữ liệu ra
    */
    public function dmQuanHuyen(Request $request){
        $data=array();
        $data=DmQuanHuyen::all();
        return view('DmQuanHuyen::dm-quan-huyen', compact('data'));
    }
    /*
     * Chức năng import dữ liệu THÔNG TIN QUẬN HUYÊN theo mẫu số 01 từ file excel 
     * Import vào cơ sở dữ liệu theo mẫu trong folder Document
     * Sau đó, return sang hàm view phía trên để lấy dữ liệu ra
    */

    public function dmQuanHuyenAndImport(Request $request){
        $data=array();
        if($request->isMethod('post')){
            Excel::import(new ReadFileExcelDmQuanHuyen,request()->file('file_excel'));
        }
         return redirect(route("dm-quan-huyen"));
    }
}