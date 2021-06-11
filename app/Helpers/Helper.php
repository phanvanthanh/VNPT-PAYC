<?php
namespace App\Helpers;
use App\Payc;
use App\ThongBao;
use App\AdminResource;
use DB;
use App\PaycXuLy;
use App\DmThamSoHeThong;
use App\BcDmThoiGianBaoCao;
use App\BcDmChiSo;
use App\UsersDonVi;

class Helper
{
    public static function kiemTraTaiKhoanThuocNhomChucVu($userId, $maNhomChucVu){
        $result=UsersDonVi::kiemTraTaiKhoanThuocNhomChucVu($userId, $maNhomChucVu);
        return $result;
    }
    public static function getParentDmChiSo($parentId){
        $dmChiSoDhsxkd=BcDmChiSo::where('id','=',$parentId)->get()->toArray();
        if(count($dmChiSoDhsxkd)>0){
            $dmChiSoDhsxkd=$dmChiSoDhsxkd[0];
        }
        return $dmChiSoDhsxkd;
    }
    public static function kiemTraVuotNgayChotSoLieu($idTuan){
        return BcDmThoiGianBaoCao::kiemTraVuotNgayChotSoLieu($idTuan);
    }

    public static function kiemTraDaChotSoLieu($idTuan, $donVi){
        return BcDmThoiGianBaoCao::kiemTraDaChotSoLieu($idTuan, $donVi);
    }
    public static function layTuanHienTai(){
        // Xem ngày hiện tại thuộc tuần thứ mấy trong năm ?
        $date = date('Y-m-d');
        while (date('w', strtotime($date)) != 1) {
        $tmp = strtotime('-1 day', strtotime($date));
        $date = date('Y-m-d', $tmp);
        }
        $week = date('W', strtotime($date));
        return $week;
    }
    public static function getValueThamSoTheoMa($maThamSo){
        $value=DmThamSoHeThong::getValueByName($maThamSo);
        return $value;
    }
    public static function layDanhSachCanBoXuLyPakn($idPakn){
        $data=PaycXuLy::layDanhSachCanBoXuLyPakn($idPakn);
        return $data;
    }
    public static function getTrangThaiXuLy($maTrangThai){
        $trangThaiXuLy=array(
            0   => 'Chưa xem',
            1   => 'Đã xem',
            2   => 'Đã xử lý',
        );
        $trangThai='Chưa xác định';
        if(isset($trangThaiXuLy[$maTrangThai])){
            $trangThai=$trangThaiXuLy[$maTrangThai];
        }
        return $trangThai;
    }
    public static function getVaiTroXuLy($maTrangThai){
        $trangThaiXuLy=array(
            0   => 'Xem để biết',
            1   => 'Xử lý chính',
            2   => 'Phối hợp xử lý',
        );
        $trangThai='Chưa xác định';
        if(isset($trangThaiXuLy[$maTrangThai])){
            $trangThai=$trangThaiXuLy[$maTrangThai];
        }
        return $trangThai;
    }
    public static function layDanhSachPaknChuaXemTheoTaiKhoan($userId){
        $data=ThongBao::layDanhSachPaknChuaXemTheoTaiKhoan($userId);
        return $data;
    }

    public static function layDanhSachBinhLuanChuaXemTheoTaiKhoan($userId){
        $data=ThongBao::layDanhSachBinhLuanChuaXemTheoTaiKhoan($userId);
        return $data;
    }

    public static function layDanhSachReourceTheoParentId($parentId){
        $data=AdminResource::layDanhSachReourceTheoParentId($parentId);
        return $data;
    }

    public static function layDanhSachDonViTheoUserId($userId){
        // Lấy quyền theo user id
       $userDonVis=DB::select('SELECT usdv.id_don_vi, ncv.ten_nhom_chuc_vu, dv.ten_don_vi, (SELECT dv2.ten_don_vi as ten_don_vi_cha FROM don_vi dv2 where dv2.id=dv.parent_id ) as ten_don_vi_cha FROM users_don_vi usdv 
            LEFT JOIN don_vi dv ON usdv.id_don_vi=dv.id
            LEFT JOIN chuc_vu cv ON usdv.id_chuc_vu=cv.id
            LEFT JOIN nhom_chuc_vu ncv ON cv.id_nhom_chuc_vu=ncv.id
            WHERE usdv.id_user='.$userId);
       $userDonVis = collect($userDonVis)->map(function($x){ return (array) $x; })->toArray();
       return $userDonVis;
    }

    public static function layDanhSachNhomQuyenTheoUserId($userId){
        // Lấy quyền theo user id
       $userRoles=DB::select('SELECT ar.role_name FROM users_role ur
            LEFT JOIN admin_role ar ON ur.role_id=ar.id
            WHERE ur.user_id='.$userId);
       $userRoles = collect($userRoles)->map(function($x){ return (array) $x; })->toArray();
       return $userRoles;
    }

    public static function layDanhSachDichVuTheoUserId($userId){
       $data=array();
        $data=DB::select('SELECT usdv.id, dv.ten_dich_vu, usdv.id_dich_vu, usdv.tu_ngay, usdv.den_ngay FROM users_dich_vu usdv
            LEFT JOIN dich_vu dv ON usdv.id_dich_vu=dv.id
            WHERE usdv.id_user='.$userId);
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;
    }

    public static function laySoLieuDanhGiaTheoIdPayc($id){
        $data=DB::select("select xl.noi_dung_xu_ly from payc_xu_ly xl
            left join payc_trang_thai_xu_ly tt on xl.id_xu_ly=tt.id
            where xl.id_payc=".$id."
            and (tt.ma_trang_thai='KH_DANH_GIA' or tt.ma_trang_thai='LD_DANH_GIA')
            and xl.noi_dung_xu_ly>0
            order by xl.id desc");
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $result=null;
        if($data){
            $result=$data[0]['noi_dung_xu_ly'];
        }
        return $result;
    }

    public static function kiemTraLoaiDanhGiaTheoIdPayc($id){ // kiểm tra loại đánh giá là khách hàng đánh giá hay lãnh đạo dánh giá
        $data=DB::select("select tt.ma_trang_thai from payc_xu_ly xl
            left join payc_trang_thai_xu_ly tt on xl.id_xu_ly=tt.id
            where xl.id_payc=".$id."
            and (tt.ma_trang_thai='KH_DANH_GIA' or tt.ma_trang_thai='LD_DANH_GIA')
            order by xl.id desc");
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $result=null;
        if($data){
            $result=$data[0]['ma_trang_thai'];
        }
        return $result;
    }

    public static function layDanhSachQuyenTheoUserId($userId){
        // Lấy quyền theo user id
       $adminRules=DB::select('select adru.resource_id from users_role ur
        left join admin_rule adru on ur.role_id=adru.role_id
        where ur.user_id='.$userId);
       $adminRules = collect($adminRules)->map(function($x){ return (array) $x; })->toArray();
       $rules=array();
       foreach ($adminRules as $key => $adminRule) {
          $rules[$adminRule['resource_id']]=$adminRule;
       }
       return $rules;
    }
    public static function getTrangThaiPaycKhachHangById($id){
        $trangThai=DB::select('select t1.id, t1.tieu_de, t2.id_user_xu_ly, t2.id_xu_ly, t3.ma_trang_thai, t3.ten_trang_thai_xu_ly, t4.name from payc t1
            right join payc_canbo_xuly_yeucau t2 on t2.id_payc=t1.id
            left join payc_trang_thai_xu_ly t3 on t2.id_xu_ly=t3.id
            left join users t4 on t2.id_user_xu_ly=t4.id
            where t1.id='.$id.' and t2.id = (
                select max(id) from payc_canbo_xuly_yeucau where id_payc='.$id.'
            );');
        if(count($trangThai)>0){
            $trangThai=$trangThai[0];
            if($trangThai->ma_trang_thai=='TAO_MOI'){
                return "Đang chờ cán bộ tiếp nhận";
            }
            if($trangThai->ma_trang_thai=='TIEP_NHAN'){
                return "Đã được tiếp nhận (bởi ".$trangThai->name.")";
            }
            if($trangThai->ma_trang_thai=='HOAN_TAT'){
                return "Đã xử lý hoàn tất";
            }
            if($trangThai->ma_trang_thai=='TU_CHOI'){
                return "Đã bị từ chối xử lý (bởi ".$trangThai->name.")";
            }
            if($trangThai->ma_trang_thai=='HUY'){
                return "Đang bị hủy (bởi ".$trangThai->name.")";
            }
            if($trangThai->ma_trang_thai=='KH_DANH_GIA'){
                return "Đang chờ bạn đánh giá";
            }
            if($trangThai->ma_trang_thai=='TRA_LAI_KHACH_HANG'){
                return "Trả lại người tạo";
            }
            else{
                return "Đang xử lý (bởi ".$trangThai->name.")";
            }

        }
        return "Không tìm được trạng thái xử lý";
    }

    public static function getTrangThaiPaycCanBoById($id){
        $trangThai=DB::select('select t1.id, t1.tieu_de, t2.id_user_xu_ly, t2.id_xu_ly, t3.ma_trang_thai, t3.ten_trang_thai_xu_ly, t4.name from payc t1
            right join payc_canbo_xuly_yeucau t2 on t2.id_payc=t1.id
            left join payc_trang_thai_xu_ly t3 on t2.id_xu_ly=t3.id
            left join users t4 on t2.id_user_xu_ly=t4.id
            where t1.id='.$id.' and t2.id = (
                select max(id) from payc_canbo_xuly_yeucau where id_payc='.$id.'
            );');
        if(count($trangThai)>0){
            $trangThai=$trangThai[0];
            if($trangThai->ma_trang_thai==1){
                return "Đang chờ tiếp nhận";
            }
            if($trangThai->ma_trang_thai==2){
                return "Đã được tiếp nhận (bởi ".$trangThai->name.')';
            }
            if($trangThai->ma_trang_thai==3){
                return "Đã xử lý hoàn tất";
            }
            if($trangThai->ma_trang_thai==4){
                return "Đã bị từ chối xử lý (bởi ".$trangThai->name.')';
            }
            if($trangThai->ma_trang_thai==5){
                return "Được chuyển đến (bởi ".$trangThai->name.")";
            }
            if($trangThai->ma_trang_thai==6){
                return "Đang được xử lý (bởi ".$trangThai->name.')';
            }
            if($trangThai->ma_trang_thai==7 || $trangThai->ma_trang_thai==8){
                return "Đã chuyển lãnh đạo duyệt (bởi ".$trangThai->name.')';
            }
            if($trangThai->ma_trang_thai==9){
                return "Đang chờ duyệt";
            }
            if($trangThai->ma_trang_thai==10){
                return "Đã trả lại cán bộ tiếp nhận (bởi ".$trangThai->name.")";
            }
            if($trangThai->ma_trang_thai==11){
                return "Đã trả lại cán bộ xử lý (bởi ".$trangThai->name.")";
            }
            if($trangThai->ma_trang_thai==12){
                return "Đang bị hủy bởi ".$trangThai->name;
            }
            if($trangThai->ma_trang_thai==13){
                return "Đang chờ KHÁCH HÀNG đánh giá";
            }
            if($trangThai->ma_trang_thai==14){
                return "Đang chờ LÃNH ĐẠO đánh giá";
            }
            if($trangThai->ma_trang_thai==15){
                return "Đang chờ CÁN BỘ đánh giá";
            }
            if($trangThai->ma_trang_thai==16){
                return "Đã duyệt";
            }
            else{
                return "Đang xử lý (bởi ".$trangThai->name.')';
            }

        }
        return "Không tìm được trạng thái xử lý";
    }


	private static $paycHasChildLevel=-1;
    private static $paycHasChildArrItem=array();
    public static function paycTreeResourceHasChild($data, $id){
        foreach ($data as $key => $item) {
            if($item['parent_id']==$id){
                Helper::$paycHasChildLevel++;
                $item['level']=Helper::$paycHasChildLevel;
                if(!isset(Helper::$paycHasChildArrItem[$item['id']])){
                	$item['has_child']=0;
					Helper::$paycHasChildArrItem[$item['id']]=$item;
					if(isset(Helper::$paycHasChildArrItem[$item['parent_id']]) && Helper::$paycHasChildArrItem[$item['parent_id']]['show_menu']==1){
						Helper::$paycHasChildArrItem[$item['parent_id']]['has_child']=Helper::$paycHasChildArrItem[$item['parent_id']]['has_child']+1; // Nếu có con thì tăng lên một đơn vị
					}
                }                	     
                unset($data[$key]);          
                Helper::paycTreeResourceHasChild($data, $item['id']);
                Helper::$paycHasChildLevel--;
            }           
        }
        return Helper::$paycHasChildArrItem;
    }

    private static $paycLevel=-1;
    private static $paycArrItem=array();
    public static function paycTreeResource($data, $id){
        foreach ($data as $key => $item) {
            if($item['parent_id']==$id){
                Helper::$paycLevel++;
                $item['level']=Helper::$paycLevel;
                if(!isset(Helper::$paycArrItem[$item['id']])){
                    $item['has_child']=0;
					Helper::$paycArrItem[$item['id']]=$item;
                    if(isset(Helper::$paycArrItem[$item['parent_id']])){
                        Helper::$paycArrItem[$item['parent_id']]['has_child']=Helper::$paycArrItem[$item['parent_id']]['has_child']+1; // Nếu có con thì tăng lên một đơn vị
                    }
                }                	     
                unset($data[$key]);          
                Helper::paycTreeResource($data, $item['id']);
                Helper::$paycLevel--;
            }           
        }
        return Helper::$paycArrItem;
    }

    private static $levelDonVi=-1;
    private static $arrDonVi=array();
    public static function layDonViConTheoMaCap($data, $id, $maCap){
        foreach ($data as $key => $item) {
            if($item['parent_id']==$id){
                Helper::$levelDonVi++;
                $item['level']=Helper::$levelDonVi;
                if(!isset(Helper::$arrDonVi[$item['id']]) && $item['ma_cap']==$maCap){
                    $item['has_child']=0;
                    Helper::$arrDonVi[$item['id']]=$item;
                    if(isset(Helper::$arrDonVi[$item['parent_id']])){
                        Helper::$arrDonVi[$item['parent_id']]['has_child']=Helper::$arrDonVi[$item['parent_id']]['has_child']+1; // Nếu có con thì tăng lên một đơn vị
                    }
                }                        
                unset($data[$key]);          
                Helper::layDonViConTheoMaCap($data, $item['id'], $maCap);
                Helper::$levelDonVi--;
            }           
        }
        return Helper::$arrDonVi;
    }


    public static function toDatePayc($datetime)
    {
        $result = '';
        try {
            $date = date_create($datetime);
            $result = $date->format('Y-m-d H:i:s');
        } catch (Exception $ex) {
            $result = date('Y-m-d H:i:s');
        }
        return $result;
    }

    private static $pathFile='public/file/payc';

    public static function getAndStoreFile($files){
        $fileNameSave='';
        foreach ($files as $key => $file) {
            $fileName=pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME).'_'.time().$key.'.'.$file->getClientOriginalExtension();
            $fileNameSave.=str_replace(' ','',$fileName.';');
            $fileName=str_replace(' ','',$fileName);
            $path = $file->storeAs(Helper::$pathFile, $fileName);
        }
        return $fileNameSave;

    }
	
	public static function tyLePhanTram($ngayGiao, $hanXuLy, $ngayThucHien){
		
		$thoiGianTong=Helper::checkHanXuLy($ngayGiao, $hanXuLy);
		$thoiGianTong=$thoiGianTong['tg'];
		if($thoiGianTong==0){
			return 100;
		}

		$thoiGianHienTai=Helper::checkHanXuLy($ngayThucHien, $hanXuLy);
		if($thoiGianHienTai['loai_han']==3){
			return 100;
		}
		
		$thoiGianHienTai=$thoiGianHienTai['tg'];
		$tyLe=100-(($thoiGianHienTai*100)/$thoiGianTong);
		return $tyLe;
	}

	public static function checkHanXuLy($date1, $date2){
		$data=array();
		if($date1=='' || $date2==''){
			$data['is_dung_han']='<span class="label label-warning">Đang xử lý </span>';
        	$data['thoi_gian_xu_ly']='Đang xử lý';
        	$data['loai_han']=0;
        	$data['tg']=0;
        	return $data;
		}
		$datetime1 = date_create($date1);
        $datetime2 = date_create($date2);
        $interval = date_diff($datetime1, $datetime2);
        $tg=0;
        $trangThai='';
        $thoiGian='';
        $loaiHan=1;
        


        
        if($interval->format('%y')>0){
            $thoiGian.=$interval->format('%y').' năm';
            $tg=$tg+($interval->format('%y')*365*24*60);
        }
        if($interval->format('%y')>0 || $interval->format('%m')>0){
            $thoiGian.=$interval->format('%m').' tháng';
            $tg=$tg+($interval->format('%m')*30*24*60);
        }
        if($interval->format('%y')>0 || $interval->format('%m')>0  || $interval->format('%d')>0){
            $thoiGian.=$interval->format('%d').' ngày';
            $tg=$tg+($interval->format('%d')*24*60);
        }
        if($interval->format('%y')>0 || $interval->format('%m')>0  || $interval->format('%d')>0 || $interval->format('%H')>0){
            $thoiGian.=$interval->format('%H').' giờ';
            $tg=$tg+($interval->format('%H')*60);
        }
        $thoiGian.=$interval->format('%i').' phút';
        $tg=$tg+$interval->format('%i');

        if($interval->format('%R')=='+'){
        	/*$tg=$interval->format('%R%y năm %m tháng %d ngày %H giờ %i phút');*/
            if($tg<=120){
                $trangThai='<span class="label label-primary">Đúng hạn </span>';
                $loaiHan=2;
            }if($tg>120){
                $trangThai='<span class="label label-success">Trước hạn </span>';
                $loaiHan=1;    
            }
            
        }
        elseif($interval->format('%R')=='-'){
            $trangThai='<span class="label label-danger">Trể hạn </span>';
            $loaiHan=3;
        }

        $data['is_dung_han']=$trangThai;
        $data['thoi_gian_xu_ly']=$thoiGian;
        $data['loai_han']=$loaiHan;
        $data['tg']=$tg;
        return $data;
	}


    private static $level_TreeDonViByParentId=0;
    private static $arrItem_TreeDonViByParentId=array();
    public static function treeDonViByParentId($data, $id){
        foreach ($data as $key => $item) {
            if($item['id']==$id){
                $item['level']=Helper::$level_TreeDonViByParentId;
                Helper::$arrItem_TreeDonViByParentId[$item['id']]=$item; 
            }
            if($item['parent_id']==$id && $item['ma_dinh_danh']==null){
                Helper::$level_TreeDonViByParentId++;
                $item['level']=Helper::$level_TreeDonViByParentId;
                if(!isset(Helper::$arrItem_TreeDonViByParentId[$item['id']])){
                    Helper::$arrItem_TreeDonViByParentId[$item['id']]=$item; 
                }                        
                unset($data[$key]);          
                Helper::treeDonViByParentId($data, $item['id']);
                Helper::$level_TreeDonViByParentId--;
            }           
        }
        return Helper::$arrItem_TreeDonViByParentId;
    }


    private static $level_TreeDonViByParentIdAndMaxLevel=0;
    private static $arrItem_TreeDonViByParentIdAndMaxLevel=array();
    public static function treeDonViByParentIdAndMaxLevel($data, $id, $maxLevel){
        foreach ($data as $key => $item) {
            if(Helper::$level_TreeDonViByParentIdAndMaxLevel<=$maxLevel){
                if($item['id']==$id){
                    $item['has_child']=1;
                    $item['level']=Helper::$level_TreeDonViByParentIdAndMaxLevel;
                    Helper::$arrItem_TreeDonViByParentIdAndMaxLevel[$item['id']]=$item; 
                }
                if($item['parent_id']==$id && $item['ma_dinh_danh']==null){
                    Helper::$level_TreeDonViByParentIdAndMaxLevel++;
                    $item['has_child']=0;
                    $item['level']=Helper::$level_TreeDonViByParentIdAndMaxLevel;
                    if(!isset(Helper::$arrItem_TreeDonViByParentIdAndMaxLevel[$item['id']])){
                        Helper::$arrItem_TreeDonViByParentIdAndMaxLevel[$item['id']]=$item; 
                        if(isset(Helper::$arrItem_TreeDonViByParentIdAndMaxLevel[$item['parent_id']])){
                            Helper::$arrItem_TreeDonViByParentIdAndMaxLevel[$item['parent_id']]['has_child']=Helper::$arrItem_TreeDonViByParentIdAndMaxLevel[$item['parent_id']]['has_child']+1; // Nếu có con thì tăng lên một đơn vị
                        }
                    }                        
                    unset($data[$key]);          
                    Helper::treeDonViByParentIdAndMaxLevel($data, $item['id'], $maxLevel);
                    Helper::$level_TreeDonViByParentIdAndMaxLevel--;
                }         
            }
                  
        }
        return Helper::$arrItem_TreeDonViByParentIdAndMaxLevel;
    }


	
}
	
?>