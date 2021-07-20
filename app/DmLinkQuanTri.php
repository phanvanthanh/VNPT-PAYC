<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UsersDichVu;

class DmLinkQuanTri extends Model
{
    protected $table='dm_link_quan_tri';
    protected $fillable=['id', 'id_dich_vu','id_user','link_chuc_nang', 'mo_ta', 'ngay_tao', 'sap_xep'];
    public $timestamps=false;


    public static function layDmLinkQuanTriTheoIdUserVaIdDichVu($dataIn){
        $result=DmLinkQuanTri::select('users.name','dm_link_quan_tri.id','dm_link_quan_tri.link_chuc_nang', 'dm_link_quan_tri.mo_ta','dm_link_quan_tri.ngay_tao','dm_link_quan_tri.sap_xep')
            ->leftJoin('users','dm_link_quan_tri.id_user','=','users.id')
            ->where('dm_link_quan_tri.id_user','=',$dataIn['id_user'])
            ->where('dm_link_quan_tri.id_dich_vu','=',$dataIn['id_dich_vu'])
            ->orderBy('dm_link_quan_tri.sap_xep','desc')
            ->get()->toArray();
        return $result;
    }
}
