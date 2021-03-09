<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class DonVi extends Model
{
    protected $table='don_vi';
    protected $fillable=['id','ten_don_vi', 'ma_phuong_xa', 'ma_cap', 'ma_dinh_danh', 'email', 'co_dinh', 'di_dong', 'fax', 'parent_id', 'level', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;

    public static function getDonViCapHuyenByMaHuyen($maHuyen){
    	$result=array();
    	$data=DB::select('select dv.* from don_vi dv
		left join dm_phuong_xa px on dv.ma_phuong_xa=px.ma_phuong_xa
		where px.ma_quan_huyen='.$maHuyen.'
		and ma_cap="HUYEN"');
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data){
			$result=$data[0];
		}
		return $result;
    }

    public static function layToThuocCapHuyenTheoMaHuyen($maHuyen){
    	$result=array();
    	$parent=DonVi::getDonViCapHuyenByMaHuyen($maHuyen);
    	$data=DB::select('select * from don_vi');
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data && $parent){
			$parentId=$parent['id'];
			$result=\Helper::treeDonViByParentId($data, $parentId);
		}
		return $result;
    }

    public static function layCanBoThuocCapHuyenTheoMaHuyen($maHuyen){
    	$result=array();
    	$parent=DonVi::getDonViCapHuyenByMaHuyen($maHuyen);
    	$data=DB::select('select * from don_vi');
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data && $parent){
			$parentId=$parent['id'];
			$result=\Helper::treeDonViByParentId($data, $parentId);
		}
		$resultCanBo=array();
		foreach ($result as $key => $rs) {
			$rs['danh_sach_can_bo']=DonVi::layCanBoTheoIdDonVi($rs['id']);
			$resultCanBo[$key]=$rs;
		}
		return $resultCanBo;
    }
    public static function layCanBoTheoIdDonVi($idDonVi){
    	$data=DB::select('select u.*, cd.ten_chuc_danh, cv.ten_chuc_vu, ncv.loai_nhom_chuc_vu from users_don_vi usdv
			left join users u on usdv.id_users=u.id
			left join chuc_danh cd on usdv.id_chuc_danh=cd.id
			left join chuc_vu cv on usdv.id_chuc_vu=cv.id
			left join nhom_chuc_vu ncv on cv.id_nhom_chuc_vu=ncv.id
			where usdv.id_don_vi='.$idDonVi);
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
    	return $data;
    }



    public static function layToThuocCapTtvtTheoMaHuyen($maHuyen){
    	$result=array();
    	$parent=DonVi::getDonViCapHuyenByMaHuyen($maHuyen);
    	$data=DB::select('select * from don_vi');
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data && $parent){
			$parentId=$parent['parent_id']; // id cấp trung tâm viễn thông
			$result=\Helper::treeDonViByParentId($data, $parentId);
		}
		return $result;
    }

    public static function layToThuocCapVttTheoMaHuyen($maHuyen){
    	$result=array();
    	$huyen=DonVi::getDonViCapHuyenByMaHuyen($maHuyen);
    	$data=DB::select('select * from don_vi');
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data && $huyen){
			$idTtvt=$huyen['parent_id'];
			$ttvt=DonVi::where('id','=',$idTtvt)->get()->toArray();
			if($ttvt){
				$idVtt=$ttvt[0]['parent_id'];
				$result=\Helper::treeDonViByParentId($data, $idVtt);
			}
			
		}
		return $result;
    }
}
