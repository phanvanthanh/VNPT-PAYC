<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class ToDo extends Authenticatable
{
    use Notifiable;

    protected $table='to_do';
    protected $fillable = [
        'id', 'id_user', 'noi_dung', 'file', 'ngay_tao', 'ngay_giao', 'han_xu_ly', 'ngay_hoan_thanh', 'trang_thai', 'sap_xep'
    ];
    public $timestamps=false;


    public static function layToDoListTheoNgay($userId, $ngay){
        $tu=$ngay.' 00:00:00';
        $sang=$ngay.' 12:00:00';
        $chieu=$ngay.' 23:59:00';
        $toDoListSang=DB::SELECT("SELECT * FROM to_do WHERE id_user=".$userId." AND DATE_FORMAT(han_xu_ly,'%d/%m/%Y %H:%i:&s')>='".$tu."' AND DATE_FORMAT(han_xu_ly,'%d/%m/%Y %H:%i:&s')<='".$sang."'");
        $toDoListSang = collect($toDoListSang)->map(function($x){ return (array) $x; })->toArray(); 


        $toDoListChieu=DB::SELECT("SELECT * FROM to_do WHERE id_user=".$userId." AND DATE_FORMAT(han_xu_ly,'%d/%m/%Y %H:%i:&s')>='".$sang."' AND DATE_FORMAT(han_xu_ly,'%d/%m/%Y %H:%i:&s')<='".$chieu."'");
        $toDoListChieu = collect($toDoListChieu)->map(function($x){ return (array) $x; })->toArray(); 

        $toDoList=array();
        $toDoList['sang']=$toDoListSang;
        $toDoList['chieu']=$toDoListChieu;
        return $toDoList;
    }
}
