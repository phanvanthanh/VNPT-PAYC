<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BcPhanQuyenBaoCao extends Model
{
    protected $table='bc_quyen_bao_cao';
    protected $fillable=['id', 'user_id', 'id_dm_quyen_bao_cao','tu_ngay', 'den_ngay'];
    public $timestamps=false;
                           
    public static function layDanhSachQuyenTheoUserId($userId)
    {
        $data=BcPhanQuyenBaoCao::where('user_id','=',$userId)->get()->toArray();
        $result=array();
        foreach ($data as $key => $d) {
            $result[$d['id_dm_quyen_bao_cao']]=$d;
        }
        return $result;
    }

    public static function kiemTraQuyenBaoCaoTheoUserIdVaMaQuyen($userId, $maQuyenBaoCao)
    {
        $data=BcPhanQuyenBaoCao::select('bc_quyen_bao_cao.id')
        ->leftJoin('bc_dm_quyen_bao_cao_tuan','bc_quyen_bao_cao.id_dm_quyen_bao_cao','=','bc_dm_quyen_bao_cao_tuan.id')
        ->where('bc_quyen_bao_cao.user_id','=',$userId)
        ->where('bc_dm_quyen_bao_cao_tuan.ma_nhom_quyen','=',$maQuyenBaoCao)
        ->get()->toArray();
        if(count($data)<=0){
            return 0;
        }
        return 1;
    }

    public static function layDichVuBaoCaoCaoMacDinh($userId, $maQuyenBaoCao)
    {
        $data=BcPhanQuyenBaoCao::select('bc_quyen_bao_cao.id')
        ->leftJoin('bc_dm_quyen_bao_cao_tuan','bc_quyen_bao_cao.id_dm_quyen_bao_cao','=','bc_dm_quyen_bao_cao_tuan.id')
        ->where('bc_quyen_bao_cao.user_id','=',$userId)
        ->where('bc_dm_quyen_bao_cao_tuan.ma_nhom_quyen','=',$maQuyenBaoCao)
        ->get()->toArray();
        return $data;
    }
}