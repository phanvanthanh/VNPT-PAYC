<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhomDichVu extends Model
{
    protected $table='nhom_dich_vu';
    protected $fillable=['id','ma_nhom_dich_vu','ten_nhom_dich_vu', 'state', 'sap_xep'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
