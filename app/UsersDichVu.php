<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class UsersDichVu extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users_dich_vu';

    protected $fillable = [
        'id','id_user', 'id_dich_vu', 'tu_ngay', 'den_ngay', 'state'
    ];
    public $timestamps=false;


    public static function getDanhSachUsersDichVuByDichVuId($idDichVu){
        $data=array();
        $data=DB::select('select usdv.id, usdv.id_user, usdv.id_dich_vu, usdv.tu_ngay, usdv.den_ngay, usdv.state, dv.ten_dich_vu, u.name, dvi.ten_don_vi from users_dich_vu usdv
            left join users u on usdv.id_user=u.id
            left join dich_vu dv on usdv.id_dich_vu=dv.id
            left join users_don_vi usdvi on usdv.id_user=usdvi.id_users
            left join don_vi dvi on usdvi.id_don_vi=dvi.id
            where (usdv.tu_ngay is null and usdv.den_ngay is null and usdv.id_dich_vu='.$idDichVu.' and usdv.state=1)
            or (usdv.tu_ngay<=sysdate() and usdv.den_ngay is null and usdv.id_dich_vu='.$idDichVu.' and usdv.state=1)
            or (usdv.tu_ngay is null and usdv.den_ngay >= sysdate() and usdv.id_dich_vu='.$idDichVu.' and usdv.state=1)
            or (usdv.tu_ngay<=sysdate() and usdv.den_ngay>=sysdate() and usdv.id_dich_vu='.$idDichVu.' and usdv.state=1)');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getUserDichVuByIdUser($idUser){
        $data=array();
        if($idUser==1){
            $data=DB::select('select dv.id, dv.ten_dich_vu from dich_vu dv');
        }else{
            $data=DB::select('select dv.id, dv.ten_dich_vu from users_dich_vu usdv
                left join dich_vu dv on usdv.id_dich_vu=dv.id
                where usdv.id_user='.$idUser);
        }
            
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

}
