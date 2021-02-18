<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class Payc extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='payc';

    protected $fillable = [
        'id','id_user_tao', 'id_dich_vu', 'tieu_de', 'noi_dung', 'file_payc', 'ngay_tao', 'han_xu_ly_mong_muon', 'han_xu_ly_duoc_giao', 'ngay_hoan_tat', 'trang_thai', 'so_phieu'
    ];
    public $timestamps=false;


    public static function getDanhSachPaycChoTiepNhan($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=1 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }
    public static function getDanhSachPaycDaTiepNhan($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=2 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getDanhSachPaycDaHoanTat($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=3 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getDanhSachPaycDaTuChoi($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=4 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getDanhSachPaycDaChuyenXuLy($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=5 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


    public static function getDanhSachPaycDangXuLy($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=6 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


    public static function getDanhSachPaycDaChuyenLanhDaoDuyet($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=7 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


    public static function getDanhSachPaycDaChuyenLanhDaoKhacDuyet($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=8 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getDanhSachPaycChoDuyet($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=9 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getDanhSachPaycDaDuyet($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=16 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


    public static function getDanhSachPaycTraLaiBuocTiepNhan($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=10 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


    public static function getDanhSachPaycTraLaiCanBoXuLy($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=11 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


    public static function getDanhSachPaycDaHuy($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=12 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


    public static function getDanhSachPaycChoKhachHangDanhGia($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=13 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getDanhSachPaycChoLanhDaoDanhGia($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=14 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getDanhSachPaycChoCanBoDanhGia($userId){
        $data=array();
        $data=DB::select('select cbxl.id,p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            where cbxl.id=(select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 where cbxl2.id_payc=cbxl.id_payc)
            and cbxl.id_xu_ly=15 and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    


}
