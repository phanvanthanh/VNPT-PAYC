<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class PaycBinhLuan extends Authenticatable
{
    use Notifiable;

    protected $table='payc_binh_luan';
    protected $fillable = [
        'id', 'id_user', 'id_payc', 'file', 'parent_id', 'ma_loai', 'ho_ten', 'noi_dung', 'hai_long', 'khong_hai_long', 'trang_thai', 'ngay_binh_luan'
    ];
    public $timestamps=false;

    public static function layDanhSachBinhLuanTheoIdPayc($id){
    	$binhLuan=PaycBinhLuan::where('id_payc','=',$id)->get()->toArray();
    	return $binhLuan;
    }
}
