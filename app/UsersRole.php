<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class UsersRole extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users_role';

    protected $fillable = [
        'id','user_id', 'role_id', 'created_at', 'updated_at'
    ];
    public $timestamps=false;
  
    public static function layDanhSachNhomQuyenTheoUserId($id){
        $data=UsersRole::where("user_id","=",$id)->get()->toArray(); // kiểm tra dữ liệu trong DB
        $result=array();
        foreach ($data as $key => $d) {
            $result[$d['role_id']]=$d;
        }
        return $result;
    }

    public static function checkUserRole($userId, $roleName){
        $data=UsersRole::select('users_role.role_id','admin_role.role_name')
        ->leftJoin('admin_role','users_role.role_id','=','admin_role.id')
        ->where("users_role.user_id",'=',$userId)
        ->where("admin_role.role_name",'=',$roleName)
        ->get()->toArray();
        if (count($data)>0) {
            return 1;
        }
        return 0;
    }
}
