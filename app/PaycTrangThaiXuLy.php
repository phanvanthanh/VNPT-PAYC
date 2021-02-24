<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class PaycTrangThaiXuLy extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='payc_trang_thai_xu_ly';

    protected $fillable = [
        'id','ma_trang_thai', 'ten_trang_thai_xu_ly', 'mo_ta', 'order', 'trang_thai'
    ];
    public $timestamps=false;

}
