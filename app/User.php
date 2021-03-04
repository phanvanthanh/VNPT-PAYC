<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'ma_xa_phuong', 'name', 'email', 'password', 'hinh_anh', 'remember_token', 'created_at', 'updated_at', 'di_dong', 'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function AdminRole(){
        return $this->belongsTo('App\AdminRole');
    }
}
