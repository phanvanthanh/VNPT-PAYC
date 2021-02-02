<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DmXaPhuong extends Model
{
    protected $table='dm_xaphuong';
    protected $fillable=['MA_PHUONG_XA', 'TEN_PHUONG_XA',	'LOAI',	'MA_QUAN_HUYEN'];
                           

}