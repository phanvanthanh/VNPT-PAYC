<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NhomChucVu extends Model
{
    protected $table='nhom_chuc_vu';
    protected $fillable=['id','ma_nhom_chuc_vu','ten_nhom_chuc_vu', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
