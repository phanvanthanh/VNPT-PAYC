<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmQuanHuyen extends Model
{
    protected $table='dm_quanhuyen';
    protected $fillable=['MA_QUAN_HUYEN', 'TEN_QUAN_HUYEN', 'LOAI', 'MA_TINH'];
                           

}