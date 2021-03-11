<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class DmThamSoHeThong extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='dm_tham_so_he_thong';

    protected $fillable = [
        'id','ma_tham_so', 'ten_tham_so', 'loai_tham_so', 'gia_tri_tham_so', 'mo_ta_tham_so'
    ];
    public $timestamps=false;

   
    public static function getValueByName($name){
        $value='';
        $data=DmThamSoHeThong::select('gia_tri_tham_so')
        ->where('ma_tham_so','=',$name)
        ->get()->toArray();
        if(count($data)>0){
            $value=$data[0]['gia_tri_tham_so'];
        }
        return $value;
    }

   

}
