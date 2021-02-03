<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ToDo extends Authenticatable
{
    use Notifiable;

    protected $table='to_do';
    protected $fillable = [
        'id', 'id_user', 'noi_dung', 'file', 'ngay_tao', 'ngay_giao', 'han_xu_ly', 'ngay_hoan_thanh', 'trang_thai', 'sap_xep'
    ];
    public $timestamps=false;
}
