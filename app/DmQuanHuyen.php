<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmQuanHuyen extends Model
{
    protected $table='dm_quan_huyen';
    protected $fillable=['ma_quan_huyen', 'ten_quan_huyen', 'loai', 'ma_tinh'];
                           

}