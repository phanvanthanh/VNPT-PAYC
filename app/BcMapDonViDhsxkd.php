<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BcMapDonViDhsxkd extends Model
{
    protected $table='bc_map_don_vi_dhsxkd';
    protected $fillable=['id','id_don_vi','id_don_vi_dhsxkd', 'ten_don_vi_dhsxkd', 'state'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;

   
}
