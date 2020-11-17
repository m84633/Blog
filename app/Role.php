<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
		'name'
	];
	public function admins()
    {
    	return $this->belongsToMany('App\Admin','admins_roles','role_id','admin_id')->withTimestamps();
    }

    public function permissions()
    {
    	return $this->belongsToMany('App\Permission','permission_role','role_id','permission_id');
    }
}
