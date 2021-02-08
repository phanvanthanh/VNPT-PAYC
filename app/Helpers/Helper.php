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



	private static $level=-1;
	private static $arrItem=array();
	public static function tableListDonVi($data, $id){
		foreach ($data as $key => $item) {
			if($item['parent']==$id){
                Helper::$level++;
                $item['level']=Helper::$level;
                Helper::$arrItem[]=$item;                
				Helper::tableListDonVi($data, $item['id']);				
				Helper::$level--;
			}			
		}
		return Helper::$arrItem;
	}


	private static $levelObj=-1;
	private static $objItem=array();
	public static function treeQuyenObj($data, $id){
		foreach ($data as $key => $item) {
			if($item->parent_id==$id){
                Helper::$level++;
                $item->level=Helper::$level;
                Helper::$objItem[]=$item;                
				Helper::treeQuyenObj($data, $item->id);				
				Helper::$level--;
			}			
		}
		return Helper::$objItem;
	}



	private static $shareDonVi='';
	public static function exportTree($data, $id){
		echo '<ul>';
		foreach ($data as $key => $item) {
			if($item['parent']==$id){
				$class='';
				if(!is_numeric($item['id'])){
					$class='name';
				}
				Helper::$shareDonVi.=$item['id'].';';
				echo '<li class="tree-show '.$class.'" data="'.$item['id'].'">'.$item['ten_don_vi'];
				Helper::exportTree($data, $item['id']);
				echo '</li>';
			}
			
		}
		echo '</ul>';
		return Helper::$shareDonVi;
	}

	public static function tableListDonViById($data, $id){
		foreach ($data as $key => $item) {
			if($item['id']==$id){
				Helper::$level++;
                $item['level']=Helper::$level;
                Helper::$arrItem[]=$item;  
			}
			if($item['parent']==$id){
                Helper::$level++;
                $item['level']=Helper::$level;
                Helper::$arrItem[]=$item;                
				Helper::tableListDonVi($data, $item['id']);				
				Helper::$level--;
			}			
		}
		return Helper::$arrItem;
	}


	public static function rightMenu($data, $id){
		echo '<ul class="nav-second-level" aria-expanded="false">';
		$stt=0;
		foreach ($data as $key => $item) {
			if($item->parent_id==$id){
				$hasChild='';
				$hasIcon='';
				foreach ($data as $key2 => $item2) {
					if($item2->parent_id==$item->id){
						$hasChild=' ';
						$hasIcon=' ';
					}
				}
				echo '<li><a class="go-to" href="/'.$item->uri.'">'.$item->ten_hien_thi.'</a>';
				Helper::rightMenu($data, $item->id);
				echo '</li>';

			}
			
		}
		echo '</ul>';
	}

	public static function menuPhanQuyen($data, $id){
		echo '<ul class="nav-second-level item-'.$id.'" aria-expanded="false">';
		$stt=0;
		foreach ($data as $key => $item) {
			if($item->parent_id==$id){
				$hasChild='';
				$hasIcon='';
				foreach ($data as $key2 => $item2) {
					if($item2->parent_id==$item->id){
						$hasChild=' ';
						$hasIcon=' ';
					}
				}
				echo '<li> <a href="#"  style="background-color: whitesmoke;"> <input type="checkbox" class="resource" name="resource_id[]" id="resource_id_'.$item->id.'" value="'.$item->id.'">'.$item->ten_hien_thi.'</a>';
				Helper::menuPhanQuyen($data, $item->id);
				echo '</li>';

			}
			
		}
		echo '</ul>';
	}

    public static function subMenu($data, $id){
		echo '<ul>';
		foreach ($data as $key => $item) {
			if($item->parent_id==$id){
				$hasChild='';
				$hasIcon='';
				foreach ($data as $key2 => $item2) {
					if($item2->parent_id==$item->id){
						$hasChild='hassubs';
						$hasIcon=' <i class="fas fa-chevron-right" style="float: right; margin-top: 24px;"></i>';
					}
				}
				echo '<li class="'.$hasChild.'"><a href="/'.$item->uri.'">'.$item->ten_hien_thi.$hasIcon.'</a>';
				Helper::subMenu($data, $item->id);
				echo '</li>';
			}
			
		}
		echo '</ul>';
	}

	public static function subCatMenu($data, $id){
		echo '<ul>';
		foreach ($data as $key => $item) {
			if($item->parent_id==$id){
				$hasChild=''; $hasIcon='';
				foreach ($data as $key2 => $item2) {
					if($item2->parent_id==$item->id){
						$hasChild='hassubs';
						$hasIcon=' <i class="fas fa-chevron-right"></i>';
					}
				}
				echo '<li class="'.$hasChild.'"><a href="#">'.$item->ten_danh_muc.$hasIcon.'</a>';
				Helper::subCatMenu($data, $item->id);
				echo '</li>';
			}
			
		}
		echo '</ul>';
	}


	public static function subMenuXs($data, $id){
		echo '<ul class="page_menu_selection">';
		foreach ($data as $key => $item) {
			if($item->parent_id==$id){
				$hasChild='';
				foreach ($data as $key2 => $item2) {
					if($item2->parent_id==$item->id){
						$hasChild='class="page_menu_item has-children"';
					}
				}
				if($hasChild==''){
					$hasChild='class="go-to"';
				}
				
				echo '<li '.$hasChild.'><a href="/'.$item->uri.'">'.$item->ten_hien_thi.'<i class="fa fa-angle-down"></i></a>';
				Helper::subMenuXs($data, $item->id);
				echo '</li>';
			}
			
		}
		echo '</ul>';
	}

	private static $capController=0;
	private static $arrController=array();

	public static function CapMenuController($data, $id){
	
		foreach ($data as $key => $item) {
			if($item['parent_id']==$id){
				Helper::$capController++;
				$item['cap']=Helper::$capController;
				Helper::$arrController[]=$item;				
				Helper::CapMenuController($data, $item['id']);
				Helper::$capController--;
			}
			
		}
		return Helper::$arrController;
	}


	private static $capLayout=0;
	private static $arrLayout=array();

	public static function CapMenuLayout($data, $id){
	
		foreach ($data as $key => $item) {
			if($item['parent_id']==$id){
				Helper::$capLayout++;
				$item['cap']=Helper::$capLayout;
				Helper::$arrLayout[]=$item;				
				Helper::CapMenuLayout($data, $item['id']);
				Helper::$capLayout--;
			}
			
		}
		return Helper::$arrLayout;
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