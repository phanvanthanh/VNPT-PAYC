<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class PaycCanBoXuLuYeuCau extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='payc_canbo_xuly_yeucau';

    protected $fillable = [
        'id','id_payc', 'id_user_xu_ly', 'id_xu_ly', 'ds_id_user_nhan', 'noi_dung_xu_ly', 'file_xu_ly', 'ngay_xu_ly', 'state'
    ];
    public $timestamps=false;

    public static function getQtxlById($idPayc){
        $data=PaycCanBoXuLuYeuCau::select('payc_canbo_xuly_yeucau.id', 'payc_canbo_xuly_yeucau.id_payc','payc_canbo_xuly_yeucau.id_user_xu_ly', 'payc_canbo_xuly_yeucau.id_xu_ly','payc_canbo_xuly_yeucau.noi_dung_xu_ly', 'payc_canbo_xuly_yeucau.file_xu_ly','payc_canbo_xuly_yeucau.ngay_xu_ly','payc_canbo_xuly_yeucau.state', 'users.name', 'payc_trang_thai_xu_ly.ma_trang_thai','payc_trang_thai_xu_ly.ten_trang_thai_xu_ly')
        ->leftJoin('payc_trang_thai_xu_ly','payc_canbo_xuly_yeucau.id_xu_ly','=','payc_trang_thai_xu_ly.id')
        ->leftJoin('users','payc_canbo_xuly_yeucau.id_user_xu_ly','=','users.id')
        ->where('payc_canbo_xuly_yeucau.id_payc','=',$idPayc)
        ->get()->toArray();
        return $data;
    }

}
