<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Payc extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='payc';

    protected $fillable = [
        'id','id_user_tao', 'id_dich_vu', 'tieu_de', 'noi_dung', 'file_payc', 'ngay_tao', 'han_xu_ly_mong_muon', 'han_xu_ly_duoc_giao', 'ngay_hoan_tat', 'trang_thai'
    ];
    public $timestamps=false;
}
