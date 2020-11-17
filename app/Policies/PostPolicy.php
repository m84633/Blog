<?php

namespace App\Policies;

use App\Admin;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(Admin $user)
    {
        foreach($user->roles as $role){
            foreach ($role->permissions as $permission) {
                if($permission->id == 1) {
                    return true;
                }  
            }
        }
        return false;
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(Admin $user)
    {
        foreach($user->roles as $role){
            foreach ($role->permissions as $permission) {
                if($permission->id == 2) {
                    return true;
                }  
            }
        }
        return false;
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(Admin $user)
    {
        return $this->getPermission($user,3); 
    }

    /**
     * Determine whether the user can restore the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function restore(User $user, Post $post)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function forceDelete(User $user, Post $post)
    {
        //
    }

    public function tags(Admin $user)
    {
        return $this->getPermission($user,6);
    }

    public function types(Admin $user)
    {
        return $this->getPermission($user,7);
    }

    protected function getPermission($user,$p_id){
    foreach($user->roles as $role){
            foreach ($role->permissions as $permission) {
                if($permission->id == $p_id) {
                    return true;
                }  
            }
        }
        return false;  

    }
}
