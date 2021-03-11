<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmPhuongXa extends Model
{
    protected $table='dm_phuong_xa';
    protected $fillable=['ma_phuong_xa', 'ten_phuong_xa', 'loai', 'ma_quan_huyen'];
                           

}