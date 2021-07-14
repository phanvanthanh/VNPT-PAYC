<?php
namespace App\Modules\TaiLieu\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Request as RequestAjax;
use App\SsoModel;
use App\User;
use Firebase\JWT\JWT;


class TaiLieuController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    public function taiLieu(Request $request){    
        return view('TaiLieu::tai-lieu');
        
    }
}