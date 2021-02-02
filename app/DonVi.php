<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonVi extends Model
{
    protected $table='don_vi';
    protected $fillable=['id','id_users','ten_don_vi', 'dia_chi', 'email', 'co_dinh', 'di_dong', 'fax', 'parent_id', 'level', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
