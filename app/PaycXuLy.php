<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class PaycXuLy extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='payc_xu_ly';

    protected $fillable = [
        'id','id_payc', 'id_user_xu_ly', 'id_xu_ly', 'noi_dung_xu_ly', 'file_xu_ly', 'ngay_xu_ly', 'state'
    ];
    public $timestamps=false;

    public static function getQtxlById($idPayc){
        $data=PaycXuLy::select('payc_xu_ly.id', 'payc_xu_ly.id_payc','payc_xu_ly.id_user_xu_ly', 'payc_xu_ly.id_xu_ly','payc_xu_ly.noi_dung_xu_ly', 'payc_xu_ly.file_xu_ly','payc_xu_ly.ngay_xu_ly','payc_xu_ly.state', 'users.name', 'payc_trang_thai_xu_ly.ma_trang_thai','payc_trang_thai_xu_ly.ten_trang_thai_xu_ly')
        ->leftJoin('payc_trang_thai_xu_ly','payc_xu_ly.id_xu_ly','=','payc_trang_thai_xu_ly.id')
        ->leftJoin('users','payc_xu_ly.id_user_xu_ly','=','users.id')
        ->where('payc_xu_ly.id_payc','=',$idPayc)
        ->get()->toArray();
        return $data;
    }


    public static function checkHoanTatById($id, $loaiDanhGia){
        $data=array();
        if($loaiDanhGia==1){
            $data=PaycXuLy::select('payc_xu_ly.id')
            ->leftJoin('payc_trang_thai_xu_ly','payc_xu_ly.id_xu_ly','=','payc_trang_thai_xu_ly.id')
            ->where('payc_trang_thai_xu_ly.ma_trang_thai','=','HOAN_TAT')
            ->where('payc_xu_ly.id_payc','=',$id)
            ->get()->toArray();
        }else{
            $data=PaycXuLy::select('payc_xu_ly.id')
            ->leftJoin('payc_trang_thai_xu_ly','payc_xu_ly.id_xu_ly','=','payc_trang_thai_xu_ly.id')
            ->where('payc_trang_thai_xu_ly.ma_trang_thai','=','KH_DANH_GIA')
            ->where('payc_xu_ly.state','=',0)
            ->where('payc_xu_ly.id_payc','=',$id)
            ->get()->toArray();
        }
        return $data;
    }

    public static function layDanhSachCanBoXuLyPakn($idPakn){
        $data=PaycXuLy::select('payc_can_bo_nhan.id', 'payc_can_bo_nhan.vai_tro', 'payc_can_bo_nhan.trang_thai', 'users.id', 'users.email', 'users.name')
        ->leftJoin('payc_trang_thai_xu_ly','payc_xu_ly.id_xu_ly','=','payc_trang_thai_xu_ly.id')
        ->leftJoin('payc_can_bo_nhan','payc_xu_ly.id','=','payc_can_bo_nhan.id_xu_ly_yeu_cau')
        ->leftJoin('users','payc_can_bo_nhan.id_user_nhan','=','users.id')
        ->where('payc_xu_ly.id_payc','=',$idPakn)
        ->where('payc_trang_thai_xu_ly.ma_trang_thai','=','DUYET_CHUYEN_XU_LY')
        ->get()->toArray();
        return $data;
    }

}
