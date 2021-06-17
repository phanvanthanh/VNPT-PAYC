<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BcDmQuyenBaoCaoTuan extends Model
{
    protected $table='bc_dm_quyen_bao_cao_tuan';
    protected $fillable=['id', 'ma_nhom_quyen', 'ten_nhom_quyen', 'trang_thai'];
                           

}