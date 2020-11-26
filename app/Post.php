<?php

namespace App;

use App\Comment as CommentEloquent;
use App\PostType as PostTypeEloquent;
use App\Tags;
use App\User as UserEloquent;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	static $play=0;
	public $player=0;
	protected $fillable = [
		'title', 'type', 'content', 'user_id'
	];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function postType(){
		return $this->belongsTo(PostTypeEloquent::class, 'type');
	}
	
	public function comments(){
		return $this->hasMany(CommentEloquent::class);
	}

	public function tags(){
		return $this->belongsToMany('App\Tags','tags_posts','post_id','tag_id')->withTimestamps();
	}

	public function play()
	{
		echo self::$play."<br>";
		self::$play++;
		echo $this->player.'<br>';
		$this->player ++;
	}

	public function likes(){
		return $this->hasMany('App\Like','post_id');
	}
}
