<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BcLogDhsxkd extends Model
{
    protected $table='bc_log_dhsxkd';
    protected $fillable=['id','user_id','send_body', 'respone_body', 'created_at'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;

   
}
