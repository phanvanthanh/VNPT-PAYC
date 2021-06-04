<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BcDmChiSo extends Model
{
    protected $table='bc_dm_chi_so';
    protected $fillable=['id','chi_so','mo_ta', 'parent_id', 'ngay_cap_nhat'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
