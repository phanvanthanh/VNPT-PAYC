<?php

namespace App;
use App\BcLogDhsxkd;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use DateTime;

use Illuminate\Support\Facades\Auth;

class BcDhsxkd extends Model
{
    protected $table='bc_dhsxkd';
    protected $fillable=['id','ma_don_vi','ma_dinh_danh', 'id_thoigian_baocao', 'id_user_bao_cao', 'chi_so', 'gia_tri', 'ghi_chu', 'is_group', 'trang_thai', 'sap_xep', 'loai_chi_so', 'suy_hao', 'suy_hao_con_lai'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;

    protected static $donVi='';

    public static function layDanhSachBcDhsxkdTheoLoai($donVi, $idThoiGianBaoCao, $loaiChiSo){        
    	BcDhsxkd::$donVi=$donVi;
        $result=BcDhsxkd::select('bc_dhsxkd.id', 'bc_dhsxkd.chi_so', 'bc_dhsxkd.gia_tri', 'bc_dhsxkd.is_group', 'bc_dhsxkd.loai_chi_so', 'bc_dhsxkd.ghi_chu', 'bc_dhsxkd.trang_thai', 'bc_dhsxkd.sap_xep', 'bc_dhsxkd.ma_dinh_danh', 'bc_dhsxkd.ma_don_vi', 'bc_dhsxkd.id_thoigian_baocao', 'bc_dhsxkd.id_user_bao_cao', 'bc_dm_chi_so.mo_ta', 'bc_dm_chi_so.parent_id', 'bc_dhsxkd.suy_hao', 'bc_dhsxkd.suy_hao_con_lai')
        ->leftJoin('bc_dm_chi_so','bc_dhsxkd.chi_so','=','bc_dm_chi_so.chi_so')                       
        ->where('id_thoigian_baocao','=',$idThoiGianBaoCao)->where('loai_chi_so','=', $loaiChiSo)
        ->where(function($query) {
            $query->where('ma_dinh_danh','=',BcDhsxkd::$donVi)->orWhere('ma_don_vi','=',BcDhsxkd::$donVi);
        })->orderBy('bc_dm_chi_so.sap_xep','asc')->orderBy('bc_dhsxkd.sap_xep','asc')->get()->toArray();
        return $result;
    }



    private static $secret_key_dhsxkd='ZXlKaGJHY2lPaUpJVXpJMU5pSXNJblI1Y0NJNklrcFhWQ0o5LmV5SnBaQ0k2SWtobWRIRmFWeUlzSW1saGRDSTZNVFl5TXpZMk1qQXlOQ3dpWlhod0lqb3pNVGN4TmpneE1EUTBNalI5LmJacnBTVmtKQzJJRlN5X056V1BwUm1XQWZLdEFXdDhFbzlMUElFeHNLV00';
    public static function getSoLieuDoHaiLongDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        
        $r = $client->request('GET', 'https://api.vnpttravinh.vn/bao-cao-tuan/do-hai-long?donvi_id='.$idDonViDhsxkd.'&tu_ngay='.$tuNgay.'&den_ngay='.$denNgay, [
                'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]
            ]);
        $decodeBody=array();
        if ($r->getStatusCode()==200) {
            $result=json_decode($r->getBody(), true);
            if(!$result){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                $decodeBody= array(
                    'message'           => 'Dữ liệu rổng',
                    'errors'            => 100,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            }else{
                $result=$result[0];
                $decodeBody= array(
                    'message'           => 'Lấy dữ liệu thành công',
                    'errors'            => 0,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => $result
                );
            }
        }else{
            $decodeBody= array(
                'message'           => 'Lấy dữ liệu thất bại',
                'errors'            => 101,
                'access_token'      => null,
                'token_type'        => null,
                'expires_at'        => date('Y-m-d H:i:s'),
                'data'              => null
            );
        }

        // Để ghi log
        $sendBody=array(
            'method'    =>'GET',
            'url'       =>'https://api.vnpttravinh.vn/bao-cao-tuan/don-vi',
            'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=Auth::id();
        BcLogDhsxkd::create($dataLog);
        // End ghi log


        return $decodeBody;
    }
    public static function getSoLieuB2ADhsxkd($idDonViDhsxkd, $tuNgay, $denNgay){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        
        $r = $client->request('GET', 'https://api.vnpttravinh.vn/bao-cao-tuan/khao-sat-b2a?donvi_id='.$idDonViDhsxkd.'&tu_ngay='.$tuNgay.'&den_ngay='.$denNgay, [
                'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]
            ]);
        $decodeBody=array();
        if ($r->getStatusCode()==200) {
            $result=json_decode($r->getBody(), true);
            if(!$result){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                $decodeBody= array(
                    'message'           => 'Dữ liệu rổng',
                    'errors'            => 100,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            }else{
                $result=$result[0];
                $decodeBody= array(
                    'message'           => 'Lấy dữ liệu thành công',
                    'errors'            => 0,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => $result
                );
            }
        }else{
            $decodeBody= array(
                'message'           => 'Lấy dữ liệu thất bại',
                'errors'            => 101,
                'access_token'      => null,
                'token_type'        => null,
                'expires_at'        => date('Y-m-d H:i:s'),
                'data'              => null
            );
        }

        // Để ghi log
        $sendBody=array(
            'method'    =>'GET',
            'url'       =>'https://api.vnpttravinh.vn/bao-cao-tuan/don-vi',
            'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=Auth::id();
        BcLogDhsxkd::create($dataLog);
        // End ghi log


        return $decodeBody;
    }
    public static function getSoLieuMatLienLacDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        
        $r = $client->request('GET', 'https://api.vnpttravinh.vn/bao-cao-tuan/mat-lien-lac?donvi_id='.$idDonViDhsxkd.'&tu_ngay='.$tuNgay.'&den_ngay='.$denNgay, [
                'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]
            ]);
        $decodeBody=array();
        if ($r->getStatusCode()==200) {
            $result=json_decode($r->getBody(), true);
            if(!$result){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                $decodeBody= array(
                    'message'           => 'Dữ liệu rổng',
                    'errors'            => 100,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            }else{
                $result=$result[0];
                $decodeBody= array(
                    'message'           => 'Lấy dữ liệu thành công',
                    'errors'            => 0,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => $result
                );
            }
        }else{
            $decodeBody= array(
                'message'           => 'Lấy dữ liệu thất bại',
                'errors'            => 101,
                'access_token'      => null,
                'token_type'        => null,
                'expires_at'        => date('Y-m-d H:i:s'),
                'data'              => null
            );
        }

        // Để ghi log
        $sendBody=array(
            'method'    =>'GET',
            'url'       =>'https://api.vnpttravinh.vn/bao-cao-tuan/don-vi',
            'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=Auth::id();
        BcLogDhsxkd::create($dataLog);
        // End ghi log


        return $decodeBody;
    }
    public static function getSoLieuXuLyDungHanDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        
        $r = $client->request('GET', 'https://api.vnpttravinh.vn/bao-cao-tuan/xu-ly-dung-han?donvi_id='.$idDonViDhsxkd.'&tu_ngay='.$tuNgay.'&den_ngay='.$denNgay, [
                'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]
            ]);
        $decodeBody=array();
        if ($r->getStatusCode()==200) {
            $result=json_decode($r->getBody(), true);
            if(!$result){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                $decodeBody= array(
                    'message'           => 'Dữ liệu rổng',
                    'errors'            => 100,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            }else{
                $result=$result[0];
                $decodeBody= array(
                    'message'           => 'Lấy dữ liệu thành công',
                    'errors'            => 0,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => $result
                );
            }
        }else{
            $decodeBody= array(
                'message'           => 'Lấy dữ liệu thất bại',
                'errors'            => 101,
                'access_token'      => null,
                'token_type'        => null,
                'expires_at'        => date('Y-m-d H:i:s'),
                'data'              => null
            );
        }

        // Để ghi log
        $sendBody=array(
            'method'    =>'GET',
            'url'       =>'https://api.vnpttravinh.vn/bao-cao-tuan/don-vi',
            'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=Auth::id();
        BcLogDhsxkd::create($dataLog);
        // End ghi log


        return $decodeBody;
    }
    public static function getSoLieuXuLySuyHaoDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        
        $r = $client->request('GET', 'https://api.vnpttravinh.vn/bao-cao-tuan/xu-ly-suy-hao?donvi_id='.$idDonViDhsxkd.'&tu_ngay='.$tuNgay.'&den_ngay='.$denNgay, [
                'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]
            ]);
        $decodeBody=array();
        if ($r->getStatusCode()==200) {
            $result=json_decode($r->getBody(), true);
            if(!$result){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                $decodeBody= array(
                    'message'           => 'Dữ liệu rổng',
                    'errors'            => 100,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            }else{
                $decodeBody= array(
                    'message'           => 'Lấy dữ liệu thành công',
                    'errors'            => 0,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => $result
                );
            }
        }else{
            $decodeBody= array(
                'message'           => 'Lấy dữ liệu thất bại',
                'errors'            => 101,
                'access_token'      => null,
                'token_type'        => null,
                'expires_at'        => date('Y-m-d H:i:s'),
                'data'              => null
            );
        }

        // Để ghi log
        $sendBody=array(
            'method'    =>'GET',
            'url'       =>'https://api.vnpttravinh.vn/bao-cao-tuan/don-vi',
            'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=Auth::id();
        BcLogDhsxkd::create($dataLog);
        // End ghi log


        return $decodeBody;
    }
    public static function getSoLieuGoiHomeDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        
        $r = $client->request('GET', 'https://api.vnpttravinh.vn/bao-cao-tuan/goi-home?donvi_id='.$idDonViDhsxkd.'&tu_ngay='.$tuNgay.'&den_ngay='.$denNgay, [
                'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]
            ]);
        $decodeBody=array();
        if ($r->getStatusCode()==200) {
            $result=json_decode($r->getBody(), true);
            if(!$result){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                $decodeBody= array(
                    'message'           => 'Dữ liệu rổng',
                    'errors'            => 100,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            }else{
                $result=$result[0];
                $decodeBody= array(
                    'message'           => 'Lấy dữ liệu thành công',
                    'errors'            => 0,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => $result
                );
            }
        }else{
            $decodeBody= array(
                'message'           => 'Lấy dữ liệu thất bại',
                'errors'            => 101,
                'access_token'      => null,
                'token_type'        => null,
                'expires_at'        => date('Y-m-d H:i:s'),
                'data'              => null
            );
        }

        // Để ghi log
        $sendBody=array(
            'method'    =>'GET',
            'url'       =>'https://api.vnpttravinh.vn/bao-cao-tuan/don-vi',
            'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=Auth::id();
        BcLogDhsxkd::create($dataLog);
        // End ghi log


        return $decodeBody;
    }
    public static function getPhatTrienMoiDhsxkd($idDonViDhsxkd, $tuNgay, $denNgay){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        
        $r = $client->request('GET', 'https://api.vnpttravinh.vn/bao-cao-tuan/phat-trien-moi?donvi_id='.$idDonViDhsxkd.'&tu_ngay='.$tuNgay.'&den_ngay='.$denNgay, [
                'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]
            ]);
        $decodeBody=array();
        if ($r->getStatusCode()==200) {
            $result=json_decode($r->getBody(), true);
            if(!$result){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                $decodeBody= array(
                    'message'           => 'Dữ liệu rổng',
                    'errors'            => 100,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => null
                );
            }else{
                $result=$result[0];
                $decodeBody= array(
                    'message'           => 'Lấy dữ liệu thành công',
                    'errors'            => 0,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s'),
                    'data'              => $result
                );
            }
        }else{
            $decodeBody= array(
                'message'           => 'Lấy dữ liệu thất bại',
                'errors'            => 101,
                'access_token'      => null,
                'token_type'        => null,
                'expires_at'        => date('Y-m-d H:i:s'),
                'data'              => null
            );
        }

        // Để ghi log
        $sendBody=array(
            'method'    =>'GET',
            'url'       =>'https://api.vnpttravinh.vn/bao-cao-tuan/don-vi',
            'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=Auth::id();
        BcLogDhsxkd::create($dataLog);
        // End ghi log


        return $decodeBody;
    }

    public static function getDonViDhsxkd(){
        // Gọi api gửi tin nhắn qua Telegram
        $client = new Client();
        
        $r = $client->request('GET', 'https://api.vnpttravinh.vn/bao-cao-tuan/don-vi', [
                'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]
            ]);
        $decodeBody=array();
        if ($r->getStatusCode()==200) {
            $decodeBody=json_decode($r->getBody(), true);
            if(!$decodeBody){ // Có trường hợp status thành công mà body thì bị rỗng. VD: bỏ headers
                $decodeBody= array(
                    'message'           => 'Dữ liệu rổng',
                    'errors'            => 100,
                    'access_token'      => null,
                    'token_type'        => null,
                    'expires_at'        => date('Y-m-d H:i:s')
                );
            }
        }else{
            $decodeBody= array(
                'message'           => 'Lấy dữ liệu thất bại',
                'errors'            => 101,
                'access_token'      => null,
                'token_type'        => null,
                'expires_at'        => date('Y-m-d H:i:s')
            );
        }
        $sendBody=array(
            'method'    =>'GET',
            'url'       =>'https://api.vnpttravinh.vn/bao-cao-tuan/don-vi',
            'headers'   =>[
                    'Content-Type'      =>'application/json',
                    'Accept'            =>'application/json',
                    'x-access-token'    =>BcDhsxkd::$secret_key_dhsxkd
                ]

        );
        $dataLog=array();
        $dataLog['send_body']=json_encode($sendBody,JSON_UNESCAPED_UNICODE);
        $dataLog['respone_body']=json_encode($decodeBody,JSON_UNESCAPED_UNICODE);
        $dataLog['user_id']=Auth::id();
        BcLogDhsxkd::create($dataLog);
        return $decodeBody;
    }
}
