<?php

namespace App;
use DateTime;
use App\BcDmTuan;
use App\DmThamSoHeThong;

use Illuminate\Database\Eloquent\Model;

class BcDmThoiGianBaoCao extends Model
{
    protected $table='bc_dm_thoi_gian_bao_cao';
    protected $fillable=['id','ma_don_vi','ma_dinh_danh', 'id_tuan', 'thoi_gian_lay_so_lieu', 'thoi_gian_chot_so_lieu', 'ghi_chu', 'trang_thai'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;

    public static function kiemTraVuotNgayChotSoLieu($idTuan){
    	// Lấy tuần năm
    	// Tính ra ngày thứ 6
    	// Nếu sau 16:30 (Số này cấu hình) thì vượt ngày chốt
    	// Ngược lại nếu trước thì chưa vượt thời gian chốt
    	$dmTuan=BcDmTuan::where('id','=',$idTuan)->get()->toArray();
    	if(count($dmTuan)<=0){
    		return 0;
    	}
    	$week=$dmTuan[0]['tuan'];
    	$year=$dmTuan[0]['nam'];
    	//$dateOfWeek=BcDmThoiGianBaoCao::getStartAndEndDateOfWeek($year, $week);
    	$thu6=$dmTuan[0]['den_ngay'];
    	$thoiGianChotBaoCao=DmThamSoHeThong::getValueByName('BC_THOI_GIAN_CHOT_BAO_CAO');
    	$ngayGioChotBaoCao=$thu6.' '.$thoiGianChotBaoCao;
    	$ngayGioHienTai=date('Y-m-d H:i:s');


    	$ngayGioHienTai = date_create($ngayGioHienTai);
        $ngayGioChotBaoCao = date_create($ngayGioChotBaoCao);
        $interval = date_diff($ngayGioChotBaoCao, $ngayGioHienTai);
        if($interval->format('%R')=='+'){ // nếu ngày hiện tại > hơn ngày báo cáo
        	return 1;
        }else{
        	return 0;
        }


    	/*$ngayGioHienTai = new DateTime($ngayGioHienTai);
		$ngayGioChotBaoCao = new DateTime($ngayGioChotBaoCao);
		if ($ngayGioChotBaoCao < $ngayGioHienTai) { // Đã vượt ngày chốt
			return 1;
		}else{ 
			return 0;
		}*/
    }


    protected static $donVi='';
    public static function kiemTraDaChotSoLieu($idTuan, $donVi){
    	// Kiểm tra đã chốt số liệu hay chưa
    	BcDmThoiGianBaoCao::$donVi=$donVi;
    	$dmThoiGianBaoCao=BcDmThoiGianBaoCao::where('id_tuan','=',$idTuan)->where(function($query) {
            $query->where('ma_dinh_danh','=',BcDmThoiGianBaoCao::$donVi)->orWhere('ma_don_vi','=',BcDmThoiGianBaoCao::$donVi);
        })->get()->toArray();
    	// Nếu có thời gian chốt và trạng thái đã chốt thì đã chốt
    	if(isset($dmThoiGianBaoCao[0]['thoi_gian_chot_so_lieu']) && isset($dmThoiGianBaoCao[0]['trang_thai'])){
    		return $dmThoiGianBaoCao[0]['trang_thai'];    		
    	}else{
    		return 0;
    	}
    }

    public static function getStartAndEndDateOfWeek($year, $week)
	{
	   return [
	      (new DateTime())->setISODate($year, $week)->format('Y-m-d'), //start date
	      (new DateTime())->setISODate($year, $week, 5)->format('Y-m-d'), //mid date
	      (new DateTime())->setISODate($year, $week, 7)->format('Y-m-d') //end date
	   ];
	}

    public static function getStartAndEndDateOfWeekFull($year, $week)
    {
       return [
          (new DateTime())->setISODate($year, $week)->format('d/m/Y'), //start date
          (new DateTime())->setISODate($year, $week,2)->format('d/m/Y'), //start date
          (new DateTime())->setISODate($year, $week,3)->format('d/m/Y'), //start date
          (new DateTime())->setISODate($year, $week,4)->format('d/m/Y'), //mid date
          (new DateTime())->setISODate($year, $week,5)->format('d/m/Y'), //end date
          (new DateTime())->setISODate($year, $week,6)->format('d/m/Y'), //end date
          (new DateTime())->setISODate($year, $week,7)->format('d/m/Y') //end date
       ];
    }
}
