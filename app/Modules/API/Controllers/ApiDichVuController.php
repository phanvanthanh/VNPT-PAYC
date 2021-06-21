<?php
namespace App\Modules\API\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Http\Controllers\Controller;
use App\DichVu;
class ApiDichVuController extends Controller
{
    
    public function layDanhMucDichVu(Request $request)
    {
        $dichVus=DichVu::where('state','=',1)->orderBy('sap_xep')->get()->toArray();
        $result['message']='Lấy danh mục dịch vụ thành công';
        $result['error']=0;
        $result['result']=$dichVus;
        return response()->json($result);
    }
}
?>