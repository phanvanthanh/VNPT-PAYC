<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRule extends Model
{
    protected $table='admin_rule';
    protected $fillable=['id','role_id', 'resource_id', 'id_app'];
    //protected $hidden=[''] // danh sách các trường muốn ẩn
    public $timestamps=false;
    public function AdminRole(){
        return $this->belongsTo('App\AdminRole');
    }
    public function AdminResource(){
        return $this->belongsTo('App\AdminResource');
    }
}