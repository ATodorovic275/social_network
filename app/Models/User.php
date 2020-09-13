<?php

namespace app\Models;

use DB;
use Illuminate\Http\Request;

class User
{
    public function insertUser($firstName, $lastName, $username, $email, $password)
    {
        // dd($lastName);
        return DB::table('users')->insertGetId(
            [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'email' => $email,
                'password' => $password
            ]
        );
    }


    public function getUserProfileInformation($request)
    {
        return DB::table('users')
            // ->select('username', 'img_src', 'img_alt')
            ->where('id_user', $request->session()->get('user')->id_user)
            ->first();
    }
    // SELECT * from user where not EXISTS(SELECT * from friends where id_friend1 = 1 AND id_friend2 = user.id)
    // SELECT * from user where user.id != 1 AND not EXISTS(SELECT * from friends where id_friend1 = 1 AND id_friend2 = user.id)


    public function getUsers($name)
    {
        return DB::table("users as u")
            ->select("u.id_user", "u.first_name", "u.last_name", "u.profile_img_src")
            ->where('u.first_name', 'like', "%" . $name . "%")
            ->orWhere("u.last_name", 'like', "%" . $name . "%")
            ->get();
    }



    public function getUserWithPosts($id)
    {
        $user = $this->getOneUser($id);

        $posts = $this->getUserPosts($id);

        // dd($posts);
        $user->posts = $posts;
        return $user;
        // dd($user);
    }



    public function getOneUser($id)
    {
        return DB::table('users')
            ->where('id_user', $id)->first();
    }


    public function getUserPosts($id)
    {
        return DB::table('posts as p')
            ->join('images as i', 'p.id_post', "i.id_post")
            ->where('id_user', $id)
            ->get();
    }


    public function getAllUsers($request = null)
    {
        $query = DB::table('users');
        if ($request) {
            // dd($request->get('user_search'));
            $query->where("username", "like", "%" . $request->get("user_search") . "%");
        }

        return $query->paginate(5);
    }


    public function delete($id)
    {
        return DB::table('users')->where('id_user', $id)->delete();
    }


    public function updateProfileImage($file, $IdUser)
    {
        return DB::table('users')
            ->where('id_user', $IdUser)
            ->update([
                'profile_img_src' => $file['file_name'],
                'profile_img_alt' => $file['alt']
            ]);
    }


    public function updateSession($idUser)
    {
        return DB::table('users')
            ->where([
                ['id_user', $idUser]
            ])->first();
    }


    public function updateUser($id, $firstName, $lastName, $username, $email)
    {
        // dd($id);
        return DB::table('users')
            ->where('id_user', $id)
            ->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'email' => $email,
                'updated' => date('Y-m-d H:i:s', time())
            ]);
    }
}
