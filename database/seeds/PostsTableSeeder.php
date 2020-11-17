<?php

use Illuminate\Database\Seeder;
use App\User as UserEloquent;
use App\Post as PostEloquent;
use App\PostType as PostTypeEloquent;
use App\Comment as CommentEloquent;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = factory(UserEloquent::class, 6)->create();
        $postTypes = factory(PostTypeEloquent::class, 10)->create();
        $posts = factory(PostEloquent::class, 50)->create()->each(function ($post) use ($postTypes) {
            $post->type = $postTypes[mt_rand(0, (count($postTypes) - 1))]->id;
            $post->save();
        });
        $comments = factory(CommentEloquent::class, 300)->create();
    }
}
