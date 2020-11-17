<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];
    public function roles()
    {
    	return $this->belongsToMany('App\Role','admins_roles','admin_id','role_id')->withTimestamps();
    }
    public function getNameAttribute($value)
    {
        return ucfirst($value); //用Auth::user()->name時會自動使用
    }
}
