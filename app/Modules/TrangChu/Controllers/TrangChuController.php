<?php
namespace App\Modules\TrangChu\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Request as RequestAjax;


class TrangChuController extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }

    public function home(Request $request){
        $client = new Client();
        
        // // Telegram
        // $r = $client->request('POST', 'https://api.telegram.org/bot1060980505:AAG8Q1xdKJa1zx0vXELYfWwus-Jl9hy1bVc/sendMessage',[
        //         'form_params' =>[
        //             'chat_id' => '-520112642',
        //             'text' => 'Test my bot'
        //         ]
        //     ]);
        // $responseStatus = $r->getStatusCode();
        
        return redirect()->route('payc');
        return view('TrangChu::home');
    }

    public function convertFileToBase64(){
        // Get the image and convert into string 
        $file = file_get_contents('http://www.orimi.com/pdf-test.pdf');           
        // Encode the image string data into base64 
        $data = base64_encode($file);
        // Display the output  or send $data
        echo $data; 
        return view('TrangChu::trang-chu');
    }
}