<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class PaycCanBoNhan extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='payc_can_bo_nhan';

    protected $fillable = [
        'id','id_xu_ly_yeu_cau', 'id_user_nhan', 'ngay_nhan', 'trang_thai'
    ];
    public $timestamps=false;

}
