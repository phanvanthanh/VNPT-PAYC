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
        'id','id_user_tao', 'id_dich_vu', 'tieu_de', 'noi_dung', 'file_payc', 'ngay_tao', 'han_xu_ly_mong_muon', 'han_xu_ly_duoc_giao', 'ngay_hoan_tat', 'trang_thai', 'so_phieu', 'ma_phuong_xa', 'vi_do', 'kinh_do'
    ];
    public $timestamps=false;


    public static function getDanhSachPaycChoTiepNhan($userId){
        $data=array();
        $data=DB::select('select cbxl.id, p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, p.id_dich_vu, dv.ten_dich_vu, p.so_phieu, ttxl.ten_trang_thai_xu_ly
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join dich_vu as dv on p.id_dich_vu=dv.id
            left join payc_trang_thai_xu_ly as ttxl on cbxl.id_xu_ly=ttxl.id
            left join payc_can_bo_nhan cbn on cbxl.id=cbn.id_xu_ly_yeu_cau
            where cbxl.id=(
                select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 
                left join payc_trang_thai_xu_ly ttxl2 on cbxl2.id_xu_ly=ttxl2.id
                where cbxl2.id_payc=cbxl.id_payc and cbxl2.id_xu_ly and ttxl2.ma_trang_thai NOT IN ("CAP_NHAT")
            )
            and (ttxl.ma_trang_thai="TAO_MOI"  or ttxl.ma_trang_thai="CHUYEN_CAN_BO")
            and cbn.id_user_nhan='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getDanhSachPaycChoXuLy($userId){
        $data=array();
        $data=DB::select('select cbxl.id, p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu, p.so_phieu, ttxl.ten_trang_thai_xu_ly
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            left join payc_trang_thai_xu_ly as ttxl on cbxl.id_xu_ly=ttxl.id
            where cbxl.id=(
                select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 
                left join payc_trang_thai_xu_ly ttxl2 on cbxl2.id_xu_ly=ttxl2.id
                where cbxl2.id_payc=cbxl.id_payc and cbxl2.id_xu_ly and ttxl2.ma_trang_thai NOT IN ("CAP_NHAT")
            )
            and (ttxl.ma_trang_thai="CHUYEN_XU_LY" or ttxl.ma_trang_thai="XU_LY" or ttxl.ma_trang_thai="CHUYEN_CAN_BO") 
            and usdv.id_user='.$userId.'
            and (cbxl.ds_id_user_nhan is null or cbxl.ds_id_user_nhan like "%'.$userId.';%")');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


    public static function getDanhSachPaycChoDuyet($userId){
        $data=array();
        $data=DB::select('select cbxl.id, p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu, p.so_phieu, ttxl.ten_trang_thai_xu_ly
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            left join payc_trang_thai_xu_ly as ttxl on cbxl.id_xu_ly=ttxl.id
            where cbxl.id=(
                select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 
                left join payc_trang_thai_xu_ly ttxl2 on cbxl2.id_xu_ly=ttxl2.id
                where cbxl2.id_payc=cbxl.id_payc and cbxl2.id_xu_ly and ttxl2.ma_trang_thai NOT IN ("CAP_NHAT")
            )
            and (ttxl.ma_trang_thai="CHUYEN_LANH_DAO" or ttxl.ma_trang_thai="DUYET" or ttxl.ma_trang_thai="LD_DANH_GIA") 
            and usdv.id_user='.$userId.'
            and (cbxl.ds_id_user_nhan is null or cbxl.ds_id_user_nhan like "%'.$userId.';%")');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getDanhSachPaycDaHoanTat($userId){
        $data=array();
        $data=DB::select('select cbxl.id, p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu, p.so_phieu, cbxl.state, ttxl.ma_trang_thai, ttxl.ten_trang_thai_xu_ly
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            left join payc_trang_thai_xu_ly as ttxl on cbxl.id_xu_ly=ttxl.id
            where cbxl.id=(
                select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 
                left join payc_trang_thai_xu_ly ttxl2 on cbxl2.id_xu_ly=ttxl2.id
                where cbxl2.id_payc=cbxl.id_payc and cbxl2.id_xu_ly and ttxl2.ma_trang_thai NOT IN ("CAP_NHAT")
            )
            and (ttxl.ma_trang_thai="HOAN_TAT" OR ttxl.ma_trang_thai="KH_DANH_GIA" or ttxl.ma_trang_thai="LD_DANH_GIA") 
            and usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


    public static function getDanhSachPaycCuaToi($userId){
        $data=array();
        $data=DB::select('select cbxl.id, p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, usdv.id_dich_vu, dv.ten_dich_vu, p.so_phieu, cbxl.state, ttxl.ma_trang_thai, ttxl.ten_trang_thai_xu_ly
            from payc as p
            left join payc_canbo_xuly_yeucau as cbxl on p.id=cbxl.id_payc
            left join users_dich_vu as usdv on p.id_dich_vu=usdv.id_dich_vu
            left join dich_vu as dv on usdv.id_dich_vu=dv.id
            left join payc_trang_thai_xu_ly as ttxl on cbxl.id_xu_ly=ttxl.id
            where (cbxl.id=(
                select max(cbxl2.id) as id from payc_canbo_xuly_yeucau cbxl2 
                where cbxl2.id_payc=cbxl.id_payc
            )
            and usdv.id_user='.$userId.')  or p.id_user_tao=1');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function taoSoPhieu(){
        $soPhieu='';
        $data=DB::select('select max(id) as id from payc');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $stt=$data[0]['id']+1;
        if($stt<10){
            $soPhieu='000'.$stt;
        }elseif($stt>=10 && $stt<100){
            $soPhieu='00'.$stt;
        }elseif ($stt>=100 && $stt<1000) {
            $soPhieu='0'.$stt;
        }else{
            $soPhieu=$stt;
        }
        $soPhieu=date('dmy').'-'.$soPhieu;
        return $soPhieu;
    }


}
