<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class PaycDiaChi extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='payc_dia_chi';

    protected $fillable = [
        'id','id_payc', 'ma_phuong_xa', 'ma_don_vi'
    ];
    public $timestamps=false;

   


   

}
