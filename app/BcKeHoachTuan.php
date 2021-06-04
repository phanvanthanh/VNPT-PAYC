<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BcKeHoachTuan extends Model
{
    protected $table='bc_ke_hoach_tuan';
    protected $fillable=['id','ma_don_vi','ma_dinh_danh', 'id_tuan', 'id_user_bao_cao', 'noi_dung', 'thoi_gian_bao_cao', 'ghi_chu', 'is_group', 'trang_thai', 'sap_xep'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
}
