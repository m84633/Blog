<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
   	protected $fillable = [
		'name', 'slug'
	];
	public function posts(){
		return $this->belongsToMany('App\Post','tags_posts','tag_id','post_id')->withTimestamps();
	}

	public function getRouteKeyName()
	{
		return 'slug';
	}
}
