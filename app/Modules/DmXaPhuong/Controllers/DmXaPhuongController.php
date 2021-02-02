<?php
namespace App\Modules\DmXaPhuong\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use App\Modules\DmXaPhuong\Models\ReadFileExcelDmXaPhuong;
use App\DmXaPhuong;



class DmXaPhuongController extends Controller{
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
    public function dmXaPhuong(Request $request){
        $data=array();
        $data=DmXaPhuong::all();
        return view('DmXaPhuong::dm-xa-phuong', compact('data'));
    }
    /*
     * Chức năng import dữ liệu THÔNG TIN XÃ PHUONG theo mẫu số 01 từ file excel 
     * Import vào cơ sở dữ liệu theo mẫu trong folder Document
     * Sau đó, return sang hàm view phía trên để lấy dữ liệu ra
    */

    public function dmXaPhuongAndImport(Request $request){
        $data=array();
        if($request->isMethod('post')){
            Excel::import(new ReadFileExcelDmXaPhuong,request()->file('file_excel'));
        }
        return redirect(route("dm-xa-phuong"));
    }
}