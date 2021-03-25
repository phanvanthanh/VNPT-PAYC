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
  

}
