<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BcDhsxkd extends Model
{
    protected $table='bc_dhsxkd';
    protected $fillable=['id','ma_don_vi','ma_dinh_danh', 'id_thoigian_baocao', 'id_user_bao_cao', 'chi_so', 'gia_tri', 'ghi_chu', 'is_group', 'trang_thai', 'sap_xep', 'loai_chi_so', 'suy_hao', 'suy_hao_con_lai'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;

    protected static $donVi='';

    public static function layDanhSachBcDhsxkdTheoLoai($donVi, $idThoiGianBaoCao, $loaiChiSo){        
    	BcDhsxkd::$donVi=$donVi;
        $result=BcDhsxkd::select('bc_dhsxkd.id', 'bc_dhsxkd.chi_so', 'bc_dhsxkd.gia_tri', 'bc_dhsxkd.is_group', 'bc_dhsxkd.loai_chi_so', 'bc_dhsxkd.ghi_chu', 'bc_dhsxkd.trang_thai', 'bc_dhsxkd.sap_xep', 'bc_dhsxkd.ma_dinh_danh', 'bc_dhsxkd.ma_don_vi', 'bc_dhsxkd.id_thoigian_baocao', 'bc_dhsxkd.id_user_bao_cao', 'bc_dm_chi_so.mo_ta', 'bc_dm_chi_so.parent_id', 'bc_dhsxkd.suy_hao', 'bc_dhsxkd.suy_hao_con_lai')
        ->leftJoin('bc_dm_chi_so','bc_dhsxkd.chi_so','=','bc_dm_chi_so.chi_so')                       
        ->where('id_thoigian_baocao','=',$idThoiGianBaoCao)->where('loai_chi_so','=', $loaiChiSo)
        ->where(function($query) {
            $query->where('ma_dinh_danh','=',BcDhsxkd::$donVi)->orWhere('ma_don_vi','=',BcDhsxkd::$donVi);
        })->orderBy('bc_dhsxkd.sap_xep','asc')->get()->toArray();
        return $result;
    }
}
