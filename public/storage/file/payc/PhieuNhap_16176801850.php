<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Illuminate\Support\Collection;

class PhieuNhap extends Authenticatable
{
    use Notifiable;

    protected $table='phieu_nhap';
    protected $fillable = [
        'id', 'id_doi_tac', 'ma_phieu_nhap', 'vat', 'chiet_khau', 'da_thanh_toan', 'ngay_nhap', 'ghi_chu', 'state'
    ];
    public $timestamps=false;


    public static function layPhieuNhapTheoId($id){
    	$data=DB::table('phieu_nhap as pn')
    	->leftJoin('doi_tac as dt','pn.id_doi_tac','=','dt.id')
    	->select('pn.id', 'pn.id_doi_tac', 'pn.ma_phieu_nhap', 'pn.vat', 'pn.chiet_khau', 'pn.da_thanh_toan', 'pn.ngay_nhap', 'pn.ghi_chu', 'pn.state', 'dt.ten_doi_tac', 'dt.ma_doi_tac', 'dt.dia_chi', 'dt.di_dong', 'dt.ten_cong_ty')
        ->where('pn.id','=',$id)->get();
    	$data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
    	return $data;
    }

    public static function layDanhSachPhieuNhap(){
        $data=DB::select('select pn.id, pn.ma_phieu_nhap, pn.id_doi_tac, dt.ma_doi_tac, dt.ten_doi_tac, dt.dia_chi, dt.di_dong, dt.email, pn.ghi_chu,
        sum(ctpn.thanh_tien) as thanh_tien, (sum(ctpn.thanh_tien)-sum(ctpn.giam_gia)) as tong_tien from phieu_nhap pn
        left join doi_tac dt on pn.id_doi_tac=dt.id
        left join chi_tiet_phieu_nhap ctpn on ctpn.id_phieu_nhap=pn.id
        group by pn.id, pn.ma_phieu_nhap, pn.id_doi_tac, dt.ma_doi_tac, dt.ten_doi_tac, dt.dia_chi, dt.di_dong, dt.email, pn.ghi_chu');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        return $data;
    }


    public static function exportPhieuNhap(){
        $data=DB::select('select pn.id, pn.ma_phieu_nhap, pn.id_doi_tac, dt.ma_doi_tac, dt.ten_doi_tac, dt.dia_chi, dt.di_dong, dt.email, 
        sum(ctpn.thanh_tien) as thanh_tien, (sum(ctpn.thanh_tien)-sum(ctpn.giam_gia)) as tong_tien from phieu_nhap pn
        left join doi_tac dt on pn.id_doi_tac=dt.id
        left join chi_tiet_phieu_nhap ctpn on ctpn.id_phieu_nhap=pn.id
        group by pn.id, pn.ma_phieu_nhap, pn.id_doi_tac, dt.ma_doi_tac, dt.ten_doi_tac, dt.dia_chi, dt.di_dong, dt.email');
        $data = collect($data)->map(function($x){ return (array) $x; })->toArray(); 
        $result=array(); $stt=0;
        foreach ($data as $key => $d) {
            $stt++;
            $d2['stt']=number_format($stt,0);
            $d2['ma_phieu_xuat']=$d['ma_phieu_nhap'];
            $d2['ten_khach_hang']=$d['ten_doi_tac'];
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
        $data=DB::select("select count(id) as stt from phieu_nhap where date_format(date(ngay_nhap),'%Y-%m-%d')=date_format(date(sysdate()),'%Y-%m-%d')");
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
        $soPhieu='PN'.date('dmy').'-'.$soPhieu;
        return $soPhieu;
    }
}
