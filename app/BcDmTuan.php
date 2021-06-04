<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BcDmTuan extends Model
{
    protected $table='bc_dm_tuan';
    protected $fillable=['id','nam','thang', 'tuan', 'tu_ngay', 'den_ngay', 'trang_thai'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
