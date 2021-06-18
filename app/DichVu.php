<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\NhomDichVu;

class DichVu extends Model
{
    protected $table='dich_vu';
    protected $fillable=['id','id_nhom_dich_vu','ten_dich_vu', 'sap_xep', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;

    public static function getMaNhomDichVuByIdDichVu($idDichVu){
    	$data=DichVu::select('nhom_dich_vu.ma_nhom_dich_vu')
    	->leftJoin('nhom_dich_vu','dich_vu.id_nhom_dich_vu','=','nhom_dich_vu.id')
    	->where('dich_vu.id','=',$idDichVu)
    	->get()->toArray();
    	$maNhomDichVu='';
    	if($data){
    		$maNhomDichVu=$data[0]['ma_nhom_dich_vu'];
    	}
    	return $maNhomDichVu;
    }
}
