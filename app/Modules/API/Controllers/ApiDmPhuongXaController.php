<?php
namespace App\Modules\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Http\Controllers\Controller;
use App\DmQuanHuyen;
use App\DmPhuongXa;
class ApiDmPhuongXaController extends Controller
{
    public function layDanhMucPhuongXa(Request $request)
    {
        $dmPhuongXas=DmPhuongXa::all()->toArray();
        $result['message']='Lấy danh mục phường/xã thành công';
        $result['error']=0;
        $result['result']=$dmPhuongXas;
        return response()->json($result);
    }

    public function layDanhMucPhuongXaTheoMaQuanHuyen(Request $request)
    {
    	$request->validate([
            'ma_quan_huyen' => 'required|numeric'
        ]);
    	$maQuanHuyen=$request->ma_quan_huyen;
        $dmPhuongXas=DmPhuongXa::where('ma_quan_huyen','=',$maQuanHuyen)->get()->toArray();
        $result['message']='Lấy danh mục phường/xã thành công';
        $result['error']=0;
        $result['result']=$dmPhuongXas;
        return response()->json($result);
    }
    
}
?>