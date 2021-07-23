<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class TaskBoard extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    /*
        trang_thai_task
            = 2 đã hoàn tất
            = 1 đang làm
            = 0 chưa làm

        loai_cong_viec
            = 1 việc cần làm
            = 2 việc phát sinh
            = 0 việc theo kế hoạch (Phần công việc = này chưa code)   

    */

    public static function danhSachPaknTheoTaiKhoan($idUser){
        $data=array();
        $data=DB::select('select distinct(cbxl.id_payc), cbxl.id, p.id_user_tao, p.tieu_de, p.noi_dung, p.file_payc, p.ngay_tao, p.han_xu_ly_mong_muon, p.han_xu_ly_duoc_giao, p.ngay_hoan_tat, ttxl.ma_trang_thai,
            cbxl.id_payc, cbxl.id_user_xu_ly, cbxl.noi_dung_xu_ly, cbxl.file_xu_ly, cbxl.ngay_xu_ly, cbxl.id_xu_ly, p.id_dich_vu, dv.ten_dich_vu, p.so_phieu, ttxl.ten_trang_thai_xu_ly,
            cbn.id_user_nhan, u.name, p.loai_cong_viec, cbn.trang_thai_task, cbn.id as tbl_can_bo_nhan_id
            from payc as p
            left join payc_xu_ly as cbxl on p.id=cbxl.id_payc
            left join dich_vu as dv on p.id_dich_vu=dv.id
            left join payc_trang_thai_xu_ly as ttxl on cbxl.id_xu_ly=ttxl.id
            left join payc_can_bo_nhan cbn on cbxl.id=cbn.id_xu_ly_yeu_cau
            left join users u on p.id_user_tao=u.id
            where cbn.id_user_nhan='.$idUser.'
            order by p.sap_xep desc');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $data2=array();
        foreach ($data as $key => $d) {
            $data2[$d['id_payc']]=$d;
        }
        
        $result=array();
        foreach ($data2 as $key => $d) {
            if($d['trang_thai_task']==2){
                $result['hoan_tat'][]=$d;
            }elseif($d['trang_thai_task']==1){
                $result['dang_lam'][]=$d;
            }else{ // Chưa làm
                if($d['loai_cong_viec']==1){
                    $result['can_lam'][]=$d;
                }
                elseif($d['loai_cong_viec']==2){
                    $result['phat_sinh'][]=$d;
                }else{
                    $result['ke_hoach'][]=$d;
                }
            }
            
        }
        return $result;
    }

}
