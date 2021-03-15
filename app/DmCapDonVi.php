<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class DmCapDonVi extends Model
{
    protected $table='dm_cap_don_vi';
    protected $fillable=['id','ma_cap', 'ten_cap'];
    public $timestamps=false;
}
