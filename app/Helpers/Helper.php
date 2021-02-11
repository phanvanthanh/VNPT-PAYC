<?php
namespace App\Helpers;

class Helper
{

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
					if(isset(Helper::$paycHasChildArrItem[$item['parent_id']])){
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
					Helper::$paycArrItem[$item['id']]=$item; 
                }                	     
                unset($data[$key]);          
                Helper::paycTreeResource($data, $item['id']);
                Helper::$paycLevel--;
            }           
        }
        return Helper::$paycArrItem;
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
            $fileNameSave.=$fileName.';';
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


	
}
	
?>