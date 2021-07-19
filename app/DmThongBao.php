<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class DmThongBao extends Authenticatable
{
    use Notifiable;

    protected $table='dm_thong_bao';
    protected $fillable = [
        'id', 'id_user_tao', 'noi_dung_thong_bao', 'url_chi_tiet', 'sap_xep', 'state'
    ];
    public $timestamps=false;
    
    

}
