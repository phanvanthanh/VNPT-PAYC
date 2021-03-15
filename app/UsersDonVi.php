<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class UsersDonVi extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users_don_vi';

    protected $fillable = [
        'id','id_don_vi', 'id_user', 'id_chuc_danh', 'id_chuc_vu', 'ma_phuong_xa', 'cap', 'ngay_bat_dau_cong_tac', 'ngay_ket_thuc_cong_tac', 'state'
    ];
    public $timestamps=false;

    public static function getDonViMacDinh($idUser){
        $data=array();
        if($idUser){
            $data=DB::select('select px.ten_phuong_xa, px.ma_phuong_xa, px.ma_quan_huyen from users_don_vi usdv
                left join don_vi dv on usdv.id_don_vi=dv.id
                left join dm_phuong_xa px on dv.ma_phuong_xa=px.ma_phuong_xa
                where usdv.id_user='.$idUser);
        }
            
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;
    }

    public static function getDanhSachCanBoTheoPhuongXaVaCap(){

    }


   

}