<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class DmThongBaoUsers extends Authenticatable
{
    use Notifiable;

    protected $table='dm_thong_bao_users';
    protected $fillable = [
        'id', 'id_user', 'id_thong_bao', 'is_da_xem', 'ngay_gio_nhan', 'ngay_gio_xem'
    ];
    public $timestamps=false;
    
    
    public static function layDanhSachThongBaoChuaXemTheoIdUser($idUser){
        $data=DmThongBaoUsers::select('dm_thong_bao_users.id','dm_thong_bao.noi_dung_thong_bao', 'dm_thong_bao.url_chi_tiet', 'dm_thong_bao_users.ngay_gio_nhan')
            ->leftJoin('dm_thong_bao','dm_thong_bao_users.id_thong_bao','=','dm_thong_bao.id')
            ->where('dm_thong_bao_users.id_user','=',$idUser)
            ->where('dm_thong_bao.state','=',1)
            ->where('dm_thong_bao_users.is_da_xem','=',0)
            ->get()->toArray();
        return $data;
    }
}
