<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use App\PaycCanBoNhan;
use App\PaycXuLy;

class ThongBao extends Authenticatable
{
    use Notifiable;

    
    public static function layDanhSachPaknChuaXemTheoTaiKhoan($userId){
        if(!isset($userId)){
            $userId=1;
        }
        $data=array();
        $data=DB::select('SELECT p.id AS id_payc, pcbn.id, u.name as ten_user_xu_ly, pcbn.ngay_nhan, p.so_phieu, p.tieu_de FROM payc p
            LEFT JOIN payc_xu_ly pxl ON p.id=pxl.id_payc
            LEFT JOIN users u ON pxl.id_user_xu_ly=u.id
            LEFT JOIN payc_can_bo_nhan pcbn ON pxl.id=pcbn.id_xu_ly_yeu_cau
            WHERE pxl.id=(
                SELECT MAX(pxl2.id) AS id FROM payc_xu_ly pxl2
                WHERE pxl2.id_payc=pxl.id_payc
            )
            AND pcbn.id_user_nhan='.$userId.'
            AND pcbn.trang_thai=0
            order by pcbn.id desc');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $result=array();
        foreach ($data as $key => $d) {
            $result[$d['id']]=$d;
        }
        return $result;

    }

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

    public static function kiemTraQuyenDanhDauDaXemBinhLuan($idBinhLuan, $idUser, $maLoaiTaiKhoan){
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

    public static function kiemTraQuyenDanhDauDaXemPakn($idNhanPakn, $idUser){
        $data=array();
        $data=DB::select('SELECT id FROM payc_can_bo_nhan WHERE id='.$idNhanPakn.' AND id_user_nhan='.$idUser
            );
            
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function capNhatTrangThaiDaXem($idPakn, $idUser){
        $datas=PaycCanBoNhan::select('payc_can_bo_nhan.id')
            ->leftJoin('payc_xu_ly','payc_can_bo_nhan.id_xu_ly_yeu_cau','=','payc_xu_ly.id')
            ->where('payc_xu_ly.id_payc','=',$idPakn)
            ->where('payc_can_bo_nhan.id_user_nhan','=',$idUser)
            ->where('payc_can_bo_nhan.vai_tro','=',0)
            ->get()->toArray();
        foreach ($datas as $key => $data) {
            $canBoNhan=PaycCanBoNhan::find($data['id']);
            $canBoNhan->trang_thai=1;
            $canBoNhan->update();
        }
        return 1;
    }

    public static function getIdPaknTheoIdPaycCanBoNhan($idCanBoNhan){
        $datas=PaycCanBoNhan::select('payc_xu_ly.id_payc')
            ->leftJoin('payc_xu_ly','payc_can_bo_nhan.id_xu_ly_yeu_cau','=','payc_xu_ly.id')
            ->where('payc_can_bo_nhan.id','=',$idCanBoNhan)
            ->get()->toArray();
        $id=0;
        if(count($datas)>0){
            $id=$datas[0]['id_payc'];
        }
        return $id;
    }


}
