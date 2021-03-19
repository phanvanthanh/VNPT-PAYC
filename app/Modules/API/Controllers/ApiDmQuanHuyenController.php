<?php
namespace App\Modules\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Http\Controllers\Controller;
use App\DmQuanHuyen;
use App\DmPhuongXa;
class ApiDmQuanHuyenController extends Controller
{
    
    public function layDanhMucQuanHuyen(Request $request)
    {
        $dmQuanHuyens=DmQuanHuyen::all()->toArray();
        $result['message']='Lấy danh mục quận/huyện thành công';
        $result['error']=0;
        $result['result']=$dmQuanHuyens;
        return response()->json($result);
    }
}
?>