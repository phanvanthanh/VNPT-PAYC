<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class ThongBao extends Authenticatable
{
    use Notifiable;

    public static function layDanhSachBinhLuanChuaXemTheoTaiKhoan($userId){
        if(!isset($userId)){
            $userId=1;
        }
        $data=array();
        $data=DB::select('SELECT distinct(bl.id) as id, bl.noi_dung, p.so_phieu, p.tieu_de, ubl.name, bl.ngay_binh_luan, p.id as id_payc
            from payc as p
            left join payc_xu_ly as cbxl on p.id=cbxl.id_payc
            left join dich_vu as dv on p.id_dich_vu=dv.id
            left join payc_trang_thai_xu_ly as ttxl on cbxl.id_xu_ly=ttxl.id
            left join payc_can_bo_nhan cbn on cbxl.id=cbn.id_xu_ly_yeu_cau
            left join users u on p.id_user_tao=u.id
            left join payc_binh_luan bl on p.id=bl.id_payc
            left join users ubl on bl.id_user=ubl.id
            where 
                bl.trang_thai=0 and bl.id_user!='.$userId.' and
                (cbxl.id_user_xu_ly='.$userId.' or cbn.id_user_nhan='.$userId.' or p.id_user_tao='.$userId.')
            order by bl.id desc');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $result=array();
        foreach ($data as $key => $d) {
            $result[$d['id']]=$d;
        }
        return $result;

    }

    public static function kiemTraQuyenDanhDauDaXem($idBinhLuan, $idUser, $maLoaiTaiKhoan){
        $data=array();
        if($maLoaiTaiKhoan=='KHACH_HANG'){
            $data=DB::select('SELECT bl.id, bl.id_payc FROM payc_binh_luan bl
                LEFT JOIN payc p ON bl.id_payc=p.id
                WHERE p.id_user_tao='.$idUser.' AND
                bl.id_user!='.$idUser.'
                AND bl.id='.$idBinhLuan
            );
        }else{
            $data=DB::select('SELECT bl.id, bl.id_payc as id
            from payc as p
            left join payc_xu_ly as cbxl on p.id=cbxl.id_payc
            left join dich_vu as dv on p.id_dich_vu=dv.id
            left join payc_trang_thai_xu_ly as ttxl on cbxl.id_xu_ly=ttxl.id
            left join payc_can_bo_nhan cbn on cbxl.id=cbn.id_xu_ly_yeu_cau
            left join users u on p.id_user_tao=u.id
            left join payc_binh_luan bl on p.id=bl.id_payc
            left join users ubl on bl.id_user=ubl.id
            where 
                bl.id_user!='.$idUser.' and bl.id='.$idBinhLuan.' and
                (cbxl.id_user_xu_ly='.$idUser.' or cbn.id_user_nhan='.$idUser.')
            order by bl.id desc'
            );
        }
            
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }


}
