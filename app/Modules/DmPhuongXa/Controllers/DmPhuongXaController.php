<?php
namespace App\Modules\DmPhuongXa\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Modules\DmPhuongXa\Models\ReadFileExcelDmPhuongXa;
use App\DmPhuongXa;



class DmPhuongXaController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    /*
     * View load dữ liệu THÔNG TIN XÃ PHƯỜNG
     * Đọc từ cơ sở dữ liệu ra
    */
    public function dmPhuongXa(Request $request){
        $data=array();
        $data=DmPhuongXa::all();
        return view('DmPhuongXa::dm-phuong-xa', compact('data'));
    }
    /*
     * Chức năng import dữ liệu THÔNG TIN XÃ PHUONG theo mẫu số 01 từ file excel 
     * Import vào cơ sở dữ liệu theo mẫu trong folder Document
     * Sau đó, return sang hàm view phía trên để lấy dữ liệu ra
    */

    public function dmPhuongXaAndImport(Request $request){
        $data=array();
        if($request->isMethod('post')){
            Excel::import(new ReadFileExcelDmPhuongXa,request()->file('file_excel'));
        }
        return redirect(route("dm-phuong-xa"));
    }
}