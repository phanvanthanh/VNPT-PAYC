<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class PaycCanBoNhan extends Authenticatable
{
    use Notifiable;

    /**
     * Vai trò: 0 xem để biết; 1 xử lý chính; 2 phối hợp xử lý
     * Trạng thái: 0 chưa xem; 1 đã xem; 2 đã xử lý
     */
    protected $table='payc_can_bo_nhan';

    protected $fillable = [
        'id','id_xu_ly_yeu_cau', 'id_user_nhan', 'ngay_nhan', 'trang_thai', 'han_xu_ly', 'ngay_hoan_tat', 'vai_tro'
    ];
    public $timestamps=false;

    public static function layIdCanBoNhanTheoIdPaycVaIdUser($idUserNhan, $idPakn){
        $data=array();
        $data=DB::select('SELECT cbn.id FROM payc_can_bo_nhan cbn
            LEFT JOIN payc_xu_ly pxl ON cbn.id_xu_ly_yeu_cau=pxl.id
            LEFT JOIN payc_trang_thai_xu_ly dmtt ON pxl.id_xu_ly=dmtt.id
            WHERE pxl.id=(
                select max(cbxl2.id) as id from payc_xu_ly cbxl2 
                left join payc_trang_thai_xu_ly ttxl2 on cbxl2.id_xu_ly=ttxl2.id
                where cbxl2.id_payc=pxl.id_payc
            )
            AND pxl.id_payc='.$idPakn.'
            AND cbn.id_user_nhan='.$idUserNhan.'
            AND cbn.trang_thai=0');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;
    }

    public static function capNhatNgayHoanTatTheoIdPaycVaIdUser($idUserNhan, $idPakn){
        $data=array();
        $data=PaycCanBoNhan::layIdCanBoNhanTheoIdPaycVaIdUser($idUserNhan, $idPakn);
        if($data){
            foreach ($data as $key => $d) {
                $paycCanBoNhan=PaycCanBoNhan::find($d['id']);
                $paycCanBoNhan->ngay_hoan_tat=date('Y-m-d H:i:s', time());
                $paycCanBoNhan->trang_thai=2;
                $paycCanBoNhan->save();
            }
            return 1;
        }
        return 0;
    }


    public static function layIdCanBoNhanTheoIdPaycVaIdUserVaVaiTroVaTrangThai($idUserNhan, $idPakn, $vaiTro, $trangThai){
        $data=array();
        $data=DB::select('SELECT cbn.id FROM payc_can_bo_nhan cbn
            LEFT JOIN payc_xu_ly pxl ON cbn.id_xu_ly_yeu_cau=pxl.id
            LEFT JOIN payc_trang_thai_xu_ly dmtt ON pxl.id_xu_ly=dmtt.id
            WHERE pxl.id=(
                select max(cbxl2.id) as id from payc_xu_ly cbxl2 
                left join payc_trang_thai_xu_ly ttxl2 on cbxl2.id_xu_ly=ttxl2.id
                where cbxl2.id_payc=pxl.id_payc
            )
            AND pxl.id_payc='.$idPakn.'
            AND cbn.id_user_nhan='.$idUserNhan.'
            AND cbn.trang_thai='.$trangThai.'
            AND cbn.vai_tro='.$vaiTro);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;
    }
    public static function capNhatDaXemTheoIdPaycVaIdUser($idPakn, $idUserNhan){
        $data=array();
        $data=PaycCanBoNhan::layIdCanBoNhanTheoIdPaycVaIdUserVaVaiTroVaTrangThai($idUserNhan, $idPakn, 0, 0);
        if($data){
            foreach ($data as $key => $d) {
                $paycCanBoNhan=PaycCanBoNhan::find($d['id']);
                $paycCanBoNhan->ngay_hoan_tat=date('Y-m-d H:i:s', time());
                $paycCanBoNhan->trang_thai=1;
                $paycCanBoNhan->save();
            }
            return 1;
        }
        return 0;
    }
    

    public static function hoanTatPhoiHopTheoIdPaycVaIdUser($idPakn, $idUserNhan){
        $data=array();
        $data=PaycCanBoNhan::layIdCanBoNhanTheoIdPaycVaIdUserVaVaiTroVaTrangThai($idUserNhan, $idPakn, 2, 0);
        if($data){
            foreach ($data as $key => $d) {
                $paycCanBoNhan=PaycCanBoNhan::find($d['id']);
                $paycCanBoNhan->ngay_hoan_tat=date('Y-m-d H:i:s', time());
                $paycCanBoNhan->trang_thai=2;
                $paycCanBoNhan->save();
            }
            return 1;
        }
        return 0;
    }

    public static function layIdCanBoNhanTheoIdPaycVaVaiTroVaTrangThai($idPakn, $vaiTro, $trangThai){
        $data=array();
        $data=DB::select('SELECT cbn.id, u.email FROM payc_can_bo_nhan cbn
            LEFT JOIN payc_xu_ly pxl ON cbn.id_xu_ly_yeu_cau=pxl.id
            LEFT JOIN payc_trang_thai_xu_ly dmtt ON pxl.id_xu_ly=dmtt.id
            LEFT JOIN users u ON cbn.id_user_nhan=u.id
            WHERE pxl.id=(
                select max(cbxl2.id) as id from payc_xu_ly cbxl2 
                left join payc_trang_thai_xu_ly ttxl2 on cbxl2.id_xu_ly=ttxl2.id
                where cbxl2.id_payc=pxl.id_payc
            )
            AND pxl.id_payc='.$idPakn.'
            AND cbn.trang_thai='.$trangThai.'
            AND cbn.vai_tro='.$vaiTro);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;
    }
    public static function kiemTraDaHoanTatPhoiHopXuLyTheoIdPakn($idPakn){
        $data=array();
        $data=PaycCanBoNhan::layIdCanBoNhanTheoIdPaycVaVaiTroVaTrangThai($idPakn, 2, 0);
        $message='';
        foreach ($data as $key => $d) {
            $message.=$d['email'].';';
        }
        return  array(
                    'error'     => count($data),
                    'message'   => $message
                );
    }
}
