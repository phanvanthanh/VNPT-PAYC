<?php

namespace App;
use DB;
use App\UsersDonVi;

use Illuminate\Database\Eloquent\Model;

class DonVi extends Model
{
    protected $table='don_vi';
    protected $fillable=['id','ten_don_vi', 'ma_don_vi', 'ma_phuong_xa', 'ma_cap', 'ma_dinh_danh', 'email', 'co_dinh', 'di_dong', 'fax', 'parent_id', 'level', 'la_don_vi_xu_ly','state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;


    /*
		Cho phép lấy đơn vị cấp trên vô tận
		VD: cấp xã, cấp huyện, cấp ttvt, cấp các trung tâm trực thuộc viễn thông, cấp viễn thông tỉnh
    */
    public static function getDonViCapTrenTheoTaiKhoan($userId, $maCap){
    	// Lấy đơn vị hiện tại của tài khoản
    	$donViHienTai=UsersDonVi::layDonViTheoTaiKhoan($userId);
    	if(count($donViHienTai)<=0){
    		$result['error']=1;
    		$result['message']='Đơn vị không tồn tại';
    		$result['data']=null;
    		return $result;
    	}
    	$idDonViHienTai=$donViHienTai[0]['id'];
    	// Lấy đơn vị chỉ định $maCap
    	$result=DonVi::layDonViTheoMaCap($idDonViHienTai,$maCap);
    	return $result;
    }

    public static function layDonViTheoMaCap($idDonViHienTai,$maCap){
    	$result=array();
    	// Check mã cấp đơn vị hiện tại 
    	$donVi=DonVi::where('id','=',$idDonViHienTai)->get()->toArray();
    	if(count($donVi)<=0){
    		$result['error']=1;
    		$result['message']='Đơn vị không tồn tại';
    		$result['data']=null;
    		return $result;
    	}
        if($maCap=='KHAC'){
            // Lấy danh mục mã các đơn vị trực thuộc khác trong DM THAM SỐ HỆ THỐNG
            $dsDonViTrucThuocKhac=DmThamSoHeThong::getValueByName('BC_DM_MA_CAP_DON_VI_TRUC_THUOC_KHAC');
            $arrDonViTrucThuocKhac=explode(',', $dsDonViTrucThuocKhac);
            foreach ($arrDonViTrucThuocKhac as $key => $maDvTt) {
                if($donVi[0]['ma_cap']==$maDvTt){
                    $result['error']=0;
                    $result['message']='Thành công';
                    $result['data']=$donVi[0];
                    return $result;
                }
            }
        }
    	// Nếu mã cấp bằng thì return
    	if($donVi[0]['ma_cap']==$maCap){
    		$result['error']=0;
    		$result['message']='Thành công';
    		$result['data']=$donVi[0];
    		return $result;
    	} // Nếu chưa bằng thì tiếp tục đệ quy
		if ($donVi[0]['parent_id']==null || $donVi[0]['id']==1 || $donVi[0]['parent_id']==0 || $donVi[0]['parent_id']=='') {
			$result['error']=2;
    		$result['message']='Tài khoản không thuộc cấp '.$maCap;
    		$result['data']=null;
    		return $result;
		}else{
			return DonVi::layDonViTheoMaCap($donVi[0]['parent_id'],$maCap);
		}
    			
    	
    }

    public static function getDonViCapXaByMaPhuongXa($maPhuongXa){
    	$result=array();
    	$data=DB::select('select dv.* from don_vi dv
		left join dm_phuong_xa px on dv.ma_phuong_xa=px.ma_phuong_xa
		where px.ma_phuong_xa='.$maPhuongXa.'
		and ma_cap="XA"');
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data){
			$result=$data[0];
		}
		return $result;
    }

    public static function layCanBoThuocCapXaTheoMaPhuongXaVaMaNhomChucVu($maPhuongXa, $maNhomChucVu, $idDichVu){
    	$result=array();
    	$parent=DonVi::getDonViCapXaByMaPhuongXa($maPhuongXa);
    	$data=DB::select('select * from don_vi');
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data && $parent){
			$parentId=$parent['id'];
			$result=\Helper::treeDonViByParentId($data, $parentId);
		}
		$resultCanBo=array();
		foreach ($result as $key => $rs) {
			$resultCanBo=array_merge($resultCanBo,DonVi::layCanBoPhuTrachTheoNhomChuVu($rs['id'],$maNhomChucVu, $idDichVu));
		}
		return $resultCanBo;
    }

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
/*
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

    public static function layDonViCanBoThuocCapHuyenTheoMaHuyen($maHuyen){
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
			$resultCanBo=array_merge($resultCanBo,DonVi::layCanBoTheoIdDonVi($rs['id']));
		}
		return $resultCanBo;
    }*/

    public static function layCanBoThuocCapHuyenTheoMaHuyenVaMaNhomChucVu($maHuyen, $maNhomChucVu, $idDichVu){
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
			
			$resultCanBo=array_merge($resultCanBo,DonVi::layCanBoPhuTrachTheoNhomChuVu($rs['id'],$maNhomChucVu, $idDichVu));
		}
		return $resultCanBo;
    }

    /*public static function layCanBoTheoIdDonVi($idDonVi){
    	$data=DB::select('select u.*, cd.ten_chuc_danh, cv.ten_chuc_vu, ncv.ma_nhom_chuc_vu from users_don_vi usdv
			left join users u on usdv.id_user=u.id
			left join chuc_danh cd on usdv.id_chuc_danh=cd.id
			left join chuc_vu cv on usdv.id_chuc_vu=cv.id
			left join nhom_chuc_vu ncv on cv.id_nhom_chuc_vu=ncv.id
			where usdv.id_don_vi='.$idDonVi);
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
    	return $data;
    }*/
    public static function layCanBoPhuTrachTheoNhomChuVu($idDonVi, $maNhomChucVu, $idDichVu){
    	$data=DB::select('select u.*, cd.ten_chuc_danh, cv.ten_chuc_vu, ncv.ma_nhom_chuc_vu 
    		from users_don_vi usdv
    		left join users_dich_vu usdvu on usdv.id_user=usdvu.id_user
			left join users u on usdv.id_user=u.id
			left join chuc_danh cd on usdv.id_chuc_danh=cd.id
			left join chuc_vu cv on usdv.id_chuc_vu=cv.id
			left join nhom_chuc_vu ncv on cv.id_nhom_chuc_vu=ncv.id
			where usdv.id_don_vi='.$idDonVi.'
			and ncv.ma_nhom_chuc_vu="'.$maNhomChucVu.'"
			and usdvu.id_dich_vu='.$idDichVu);
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
    	return $data;
    }

    public static function layCanBoThuocCapTtvtTheoMaHuyenVaMaNhomChucVu($maHuyen, $maNhomChucVu, $idDichVu){
    	$result=array();
    	$parent=DonVi::getDonViCapHuyenByMaHuyen($maHuyen);
    	$data=DB::select('select * from don_vi');
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data && $parent){
			$parentId=$parent['parent_id']; // id cấp trung tâm viễn thông
			$result=\Helper::treeDonViByParentId($data, $parentId);
		}

		$resultCanBo=array();
		foreach ($result as $key => $rs) {
			
			$resultCanBo=array_merge($resultCanBo,DonVi::layCanBoPhuTrachTheoNhomChuVu($rs['id'],$maNhomChucVu, $idDichVu));
		}
		return $resultCanBo;
    }

    public static function getDonViCapTrungTamTheoMaCap($maCap){
    	$result=array();
    	$data=DB::select('SELECT * FROM don_vi
		WHERE ma_cap="'.$maCap.'"');
		$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data){
			$result=$data[0];
		}
		return $result;
    }

    public static function layCanBoThuocCapTrungTamTheoMaNhomChucVu($maCap, $maNhomChucVu, $idDichVu){
    	$result=array();
    	$parent=DonVi::getDonViCapTrungTamTheoMaCap($maCap);
    	$data=DB::select('select * from don_vi');
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
		if($data && $parent){
			$parentId=$parent['id']; // id cấp trung tâm viễn thông
			$result=\Helper::treeDonViByParentId($data, $parentId);
		}

		$resultCanBo=array();
		foreach ($result as $key => $rs) {
			
			$resultCanBo=array_merge($resultCanBo,DonVi::layCanBoPhuTrachTheoNhomChuVu($rs['id'],$maNhomChucVu, $idDichVu));
		}
		return $resultCanBo;
    }



    /*

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
    }*/
}
