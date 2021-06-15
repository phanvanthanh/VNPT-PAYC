<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Illuminate\Support\Collection;

class PhieuXuat extends Authenticatable
{
    use Notifiable;

    protected $table='phieu_xuat';
    protected $fillable = [
        'id', 'id_khach_hang', 'ma_phieu_xuat', 'vat', 'chiet_khau', 'da_thanh_toan', 'ngay_xuat', 'ghi_chu', 'state'
    ];
    public $timestamps=false;

    public static function layPhieuXuatTheoId($id){
    	$data=DB::table('phieu_xuat as px')
    	->leftJoin('khach_hang as kh','px.id_khach_hang','=','kh.id')
    	->select('px.id', 'px.id_khach_hang', 'px.ma_phieu_xuat', 'px.vat', 'px.chiet_khau', 'px.da_thanh_toan', 'px.ngay_xuat', 'px.ghi_chu', 'px.state', 'kh.ten_khach_hang', 'kh.ma_khach_hang', 'kh.dia_chi', 'kh.di_dong', 'kh.ten_cong_ty')
    	->where('px.id','=',$id)->get();
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
    	return $data;
    }

    public static function layDanhSachPhieuXuat(){
    	$data=DB::select('select px.id, px.ma_phieu_xuat, kh.ten_khach_hang, kh.ma_khach_hang, kh.dia_chi, kh.di_dong, kh.email, px.ghi_chu, 
		sum(ctpx.giam_gia), sum(ctpx.thanh_tien), (sum(ctpx.thanh_tien)-sum(ctpx.giam_gia)) as tong_tien	
		from phieu_xuat px
		left join chi_tiet_phieu_xuat ctpx on px.id=ctpx.id_phieu_xuat
		left join khach_hang kh on px.id_khach_hang=kh.id
		group by px.id, px.ma_phieu_xuat, kh.ten_khach_hang, kh.ma_khach_hang, kh.dia_chi, kh.di_dong, kh.email, px.ghi_chu');
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
    	return $data;
    }

    public static function exportPhieuXuat(){
        $data=DB::select('select px.id, px.ma_phieu_xuat, kh.ten_khach_hang, kh.ma_khach_hang, kh.dia_chi, kh.di_dong, kh.email, 
        sum(ctpx.giam_gia), sum(ctpx.thanh_tien), (sum(ctpx.thanh_tien)-sum(ctpx.giam_gia)) as tong_tien    
        from phieu_xuat px
        left join chi_tiet_phieu_xuat ctpx on px.id=ctpx.id_phieu_xuat
        left join khach_hang kh on px.id_khach_hang=kh.id
        group by px.id, px.ma_phieu_xuat, kh.ten_khach_hang, kh.ma_khach_hang, kh.dia_chi, kh.di_dong, kh.email');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $result=array(); $stt=0;
        foreach ($data as $key => $d) {
            $stt++;
            $d2['stt']=number_format($stt,0);
            $d2['ma_phieu_xuat']=$d['ma_phieu_xuat'];
            $d2['ten_khach_hang']=$d['ten_khach_hang'];
            $d2['di_dong']=$d['di_dong'];
            $d2['email']=$d['email'];
            $d2['dia_chi']=$d['dia_chi'];
            $d2['tong_tien']=number_format($d['tong_tien'],0);
            $result[]=$d2;
        }
        $collection = collect($result);
        $collection = Collection::make($collection);
        return $collection;
    }

    public static function taoSoPhieu(){
        $soPhieu='';
        $data=DB::select("select count(id) as stt from phieu_xuat where date_format(date(ngay_xuat),'%Y-%m-%d')=date_format(date(sysdate()),'%Y-%m-%d')");
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $stt=$data[0]['stt']+1;
        if($stt<10){
            $soPhieu='000'.$stt;
        }elseif($stt>=10 && $stt<100){
            $soPhieu='00'.$stt;
        }elseif ($stt>=100 && $stt<1000) {
            $soPhieu='0'.$stt;
        }else{
            $soPhieu=$stt;
        }
        $soPhieu='PX'.date('dmy').'-'.$soPhieu;
        return $soPhieu;
    }
}
