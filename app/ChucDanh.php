<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ChucDanh extends Model
{
    protected $table='chuc_danh';
    protected $fillable=['id','ten_chuc_danh', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
