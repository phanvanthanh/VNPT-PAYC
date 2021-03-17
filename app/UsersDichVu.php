<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class UsersDichVu extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users_dich_vu';

    protected $fillable = [
        'id','id_user', 'id_dich_vu', 'tu_ngay', 'den_ngay', 'state'
    ];
    public $timestamps=false;

    public static function layDanhSachCanBoXuLy($userId){
        // Lấy danh sách các đơn vị mà user hiện tại đang công tác
        $curentDonVis=DB::select('select usdv.*, dv.parent_id, dv.ten_don_vi from users_don_vi usdv
        left join don_vi dv on usdv.id_don_vi=dv.id
        where usdv.id_user='.$userId);
        $curentDonVis = collect($curentDonVis)->map(function($x){ return (array) $x; })->toArray(); 
        // Lấy danh sách tất cả đơn vị
        $donVis=DB::select('select * from don_vi');
        $donVis = collect($donVis)->map(function($x){ return (array) $x; })->toArray(); 
        $danhSachDonVi=array();
        // lấy đầy đủ các phòng ban cùng cấp với user đang công tác
        foreach ($curentDonVis as $key => $curentDonVi) {
            $danhSachDonVi=array_merge($danhSachDonVi,\Helper::treeDonViByParentIdAndMaxLevel($donVis, $curentDonVi['parent_id'], 1));
        }
        $result=array();
        foreach ($danhSachDonVi as $key => $donVi) {
            $dsCanBo=DB::select('select u.*, usdv.id_don_vi, dv.ten_don_vi, dv.parent_id, ncv.ten_nhom_chuc_vu from users_don_vi usdv
                left join users u on usdv.id_user=u.id
                left join chuc_vu cv on usdv.id_chuc_vu=cv.id
                left join nhom_chuc_vu ncv on cv.id_nhom_chuc_vu=ncv.id
                left join don_vi dv on usdv.id_don_vi=dv.id
                where usdv.id_don_vi='.$donVi['id'].'
                and ncv.ma_nhom_chuc_vu="XU_LY"');
            $dsCanBo = collect($dsCanBo)->map(function($x){ return (array) $x; })->toArray(); 
            $donVi['ds_can_bo']=$dsCanBo;
            $result[$donVi['id']]=$donVi;
        }
        return $result;
    }

    public static function layDanhSachLanhDao($userId){
        // Lấy danh sách các đơn vị mà user hiện tại đang công tác
        $curentDonVis=DB::select('select usdv.*, dv.parent_id, dv.ten_don_vi from users_don_vi usdv
        left join don_vi dv on usdv.id_don_vi=dv.id
        where usdv.id_user='.$userId);
        $curentDonVis = collect($curentDonVis)->map(function($x){ return (array) $x; })->toArray(); 
        // Lấy danh sách tất cả đơn vị
        $donVis=DB::select('select * from don_vi');
        $donVis = collect($donVis)->map(function($x){ return (array) $x; })->toArray(); 
        $danhSachDonVi=array();
        // lấy đầy đủ các phòng ban cùng cấp với user đang công tác
        foreach ($curentDonVis as $key => $curentDonVi) {
            $danhSachDonVi=array_merge($danhSachDonVi,\Helper::treeDonViByParentIdAndMaxLevel($donVis, $curentDonVi['parent_id'], 1));
        }
        $result=array();
        foreach ($danhSachDonVi as $key => $donVi) {
            $dsCanBo=DB::select('select u.*, usdv.id_don_vi, dv.ten_don_vi, dv.parent_id, ncv.ten_nhom_chuc_vu from users_don_vi usdv
                left join users u on usdv.id_user=u.id
                left join chuc_vu cv on usdv.id_chuc_vu=cv.id
                left join nhom_chuc_vu ncv on cv.id_nhom_chuc_vu=ncv.id
                left join don_vi dv on usdv.id_don_vi=dv.id
                where usdv.id_don_vi='.$donVi['id'].'
                and ncv.ma_nhom_chuc_vu="LANH_DAO"');
            $dsCanBo = collect($dsCanBo)->map(function($x){ return (array) $x; })->toArray(); 
            $donVi['ds_can_bo']=$dsCanBo;
            $result[$donVi['id']]=$donVi;
        }
        return $result;
    }

    public static function layDanhSachDonViCapTren($userId){
        // Lấy danh sách các đơn vị mà user hiện tại đang công tác
        $donVis=DonVi::where('la_don_vi_xu_ly','=',1)->orderBy('ma_cap','asc')->get()->toArray();
        $donVis=\Helper::paycTreeResource($donVis,null);
        return $donVis;
    }

    public static function layDanhSachCanBoTheoIdDonViVaMaNhomChucVu($idDonVi, $maNhomChucVu){
        $dsCanBo=DB::select('select u.*, usdv.id_don_vi, dv.ten_don_vi, dv.parent_id, ncv.ten_nhom_chuc_vu from users_don_vi usdv
            left join users u on usdv.id_user=u.id
            left join chuc_vu cv on usdv.id_chuc_vu=cv.id
            left join nhom_chuc_vu ncv on cv.id_nhom_chuc_vu=ncv.id
            left join don_vi dv on usdv.id_don_vi=dv.id
            where usdv.id_don_vi='.$idDonVi.'
            and ncv.ma_nhom_chuc_vu="'.$maNhomChucVu.'"');
        $dsCanBo = collect($dsCanBo)->map(function($x){ return (array) $x; })->toArray(); 
        return $dsCanBo;
    }


    public static function layDanhSachCanBo($userId){
        // Lấy danh sách các đơn vị mà user hiện tại đang công tác
        $curentDonVis=DB::select('select usdv.*, dv.parent_id, dv.ten_don_vi from users_don_vi usdv
        left join don_vi dv on usdv.id_don_vi=dv.id
        where usdv.id_user='.$userId);
        $curentDonVis = collect($curentDonVis)->map(function($x){ return (array) $x; })->toArray(); 
        // Lấy danh sách tất cả đơn vị
        $donVis=DB::select('select * from don_vi');
        $donVis = collect($donVis)->map(function($x){ return (array) $x; })->toArray(); 
        $danhSachDonVi=array();
        // lấy đầy đủ các phòng ban cùng cấp với user đang công tác
        foreach ($curentDonVis as $key => $curentDonVi) {
            $danhSachDonVi=array_merge($danhSachDonVi,\Helper::treeDonViByParentIdAndMaxLevel($donVis, $curentDonVi['parent_id'], 1));
        }
        $result=array();
        foreach ($danhSachDonVi as $key => $donVi) {
            $dsCanBo=DB::select('select u.*, usdv.id_don_vi, dv.ten_don_vi, dv.parent_id, ncv.ten_nhom_chuc_vu from users_don_vi usdv
                left join users u on usdv.id_user=u.id
                left join chuc_vu cv on usdv.id_chuc_vu=cv.id
                left join nhom_chuc_vu ncv on cv.id_nhom_chuc_vu=ncv.id
                left join don_vi dv on usdv.id_don_vi=dv.id
                where usdv.id_don_vi='.$donVi['id']);
            $dsCanBo = collect($dsCanBo)->map(function($x){ return (array) $x; })->toArray(); 
            $donVi['ds_can_bo']=$dsCanBo;
            $result[$donVi['id']]=$donVi;
        }
        return $result;
    }

    public static function layDanhSachCanBoTiepNhanVaXuLy($userId){
        // Lấy danh sách các đơn vị mà user hiện tại đang công tác
        $curentDonVis=DB::select('select usdv.*, dv.parent_id, dv.ten_don_vi from users_don_vi usdv
        left join don_vi dv on usdv.id_don_vi=dv.id
        where usdv.id_user='.$userId);
        $curentDonVis = collect($curentDonVis)->map(function($x){ return (array) $x; })->toArray(); 
        // Lấy danh sách tất cả đơn vị
        $donVis=DB::select('select * from don_vi');
        $donVis = collect($donVis)->map(function($x){ return (array) $x; })->toArray(); 
        $danhSachDonVi=array();
        // lấy đầy đủ các phòng ban cùng cấp với user đang công tác
        foreach ($curentDonVis as $key => $curentDonVi) {
            $danhSachDonVi=array_merge($danhSachDonVi,\Helper::treeDonViByParentIdAndMaxLevel($donVis, $curentDonVi['parent_id'], 1));
        }
        $result=array();
        foreach ($danhSachDonVi as $key => $donVi) {
            $dsCanBo=DB::select('select u.*, usdv.id_don_vi, dv.ten_don_vi, dv.parent_id, ncv.ten_nhom_chuc_vu from users_don_vi usdv
                left join users u on usdv.id_user=u.id
                left join chuc_vu cv on usdv.id_chuc_vu=cv.id
                left join nhom_chuc_vu ncv on cv.id_nhom_chuc_vu=ncv.id
                left join don_vi dv on usdv.id_don_vi=dv.id
                where usdv.id_don_vi='.$donVi['id'].'
                and (ncv.ma_nhom_chuc_vu="XU_LY"
                or ncv.ma_nhom_chuc_vu="TIEP_NHAN")');
            $dsCanBo = collect($dsCanBo)->map(function($x){ return (array) $x; })->toArray(); 
            $donVi['ds_can_bo']=$dsCanBo;
            $result[$donVi['id']]=$donVi;
        }
        return $result;
    }


    public static function getDanhSachUsersDichVuByDichVuId($idDichVu){
        $data=array();
        $data=DB::select('select usdv.id, usdv.id_user, usdv.id_dich_vu, usdv.tu_ngay, usdv.den_ngay, usdv.state, dv.ten_dich_vu, u.name, dvi.ten_don_vi from users_dich_vu usdv
            left join users u on usdv.id_user=u.id
            left join dich_vu dv on usdv.id_dich_vu=dv.id
            left join users_don_vi usdvi on usdv.id_user=usdvi.id_user
            left join don_vi dvi on usdvi.id_don_vi=dvi.id
            where (usdv.tu_ngay is null and usdv.den_ngay is null and usdv.id_dich_vu='.$idDichVu.' and usdv.state=1)
            or (usdv.tu_ngay<=sysdate() and usdv.den_ngay is null and usdv.id_dich_vu='.$idDichVu.' and usdv.state=1)
            or (usdv.tu_ngay is null and usdv.den_ngay >= sysdate() and usdv.id_dich_vu='.$idDichVu.' and usdv.state=1)
            or (usdv.tu_ngay<=sysdate() and usdv.den_ngay>=sysdate() and usdv.id_dich_vu='.$idDichVu.' and usdv.state=1)');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

    public static function getUserDichVuByIdUser($idUser){
        /*$data=array();
        if($idUser==1){
            $data=DB::select('select dv.id, dv.ten_dich_vu from dich_vu dv');
        }else{
            $data=DB::select('select dv.id, dv.ten_dich_vu from users_dich_vu usdv
                left join dich_vu dv on usdv.id_dich_vu=dv.id
                where usdv.id_user='.$idUser);
        }*/

        $data=DB::select('select dv.id, dv.ten_dich_vu from dich_vu dv');
            
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;

    }

}
