<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ChucVu extends Model
{
    protected $table='chuc_vu';
    protected $fillable=['id','id_nhom_dich_vu','ten_chuc_vu', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;

}
