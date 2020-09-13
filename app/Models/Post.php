<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Post
{
    public function insert($request)
    {
        // dd(session('user')->id);
        return DB::table('posts')
            ->insertGetId([
                'description' => $request->input('post_description'),
                "id_user" => session('user')->id_user
            ]);
    }


    public function updatePost($idPost, $description)
    {
        return DB::table('posts')
            ->where('id_post', $idPost)
            ->update([
                'description' => $description
            ]);
    }



    public function postOfUserAndFriends($idUser)
    {
        // SELECT p.*, i.* FROM user u INNER JOIN friends f ON u.id = f.id_friend2 INNER JOIN posts p ON u.id = p.id_user inner join images i on p.id_post = i.id_post WHERE f.id_friend1 = 1 OR u.id = 1

        // SELECT p.*, i.*, c.* FROM user u INNER JOIN friends f ON u.id = f.id_friend2 INNER JOIN posts p ON u.id = p.id_user inner join images i on p.id_post = i.id_post INNER JOIN comments c ON p.id_post = c.id_post WHERE f.id_friend1 = 1 OR u.id = 1

        //postovi prijatelja
        // $posts = DB::table('users as u')
        //     ->select("p.*", "i.*", "u.*")
        //     ->join('friends as f', 'u.id_user', "f.id_friend2")
        //     ->join('posts as p', "u.id_user", "p.id_user")
        //     ->join("images as i", "p.id_post", "i.id_post")
        //     // ->leftJoin("comments as c", "p.id_post", "c.id_post")
        //     ->where("f.id_friend1", $idUser)
        //     // ->orWhere("u.id_user", "1")
        //     ->orderBy("p.created", "desc")
        //     ->get();
        // ne dobijam komentare tog korisnika




        // dd($posts);
        // $posts = DB::select("SELECT p.*, i.* FROM users u INNER JOIN friends f ON u.id_user = f.id_friend2 INNER JOIN posts p ON u.id_user = p.id_user inner join images i on p.id_post = i.id_post  WHERE f.id_friend1 = 1");



        // SELECT p.*, i.* FROM users u INNER JOIN posts p ON u.id_user = p.id_user INNER JOIN images i ON p.id_post = i.id_post WHERE p.id_user = 1 or p.id_user IN (select u.id_user from users u inner join friends f on u.id_user = f.id_friend2 WHERE f.id_friend1 = 1)

        $posts = DB::select("SELECT p.*, i.*, u.* FROM users u INNER JOIN posts p ON u.id_user = p.id_user INNER JOIN images i ON p.id_post = i.id_post  WHERE p.id_user = $idUser or p.id_user IN (select u.id_user from users u inner join friends f on u.id_user = f.id_friend2 WHERE f.id_friend1 = $idUser) ORDER BY p.created_post DESC");


        // $posts = DB::table('users as u')
        //     ->join('posts as p', 'u.id_user', 'p.id_user')
        //     ->where('p.id_user', $idUser)
        //     ->whereIn(DB::raw("(select u.id_user from users u inner join friends f on u.id_user = f.id_friend2 WHERE f.id_friend1 = $idUser"))
        //     ->get();

        foreach ($posts as $p) {
            $comments = $this->getPostComment($p->id_post);
            $numberOfComments = $this->getNumberOfCommentsForPost($p->id_post);
            $p->comments = $comments;
            $p->numberOfComments = $numberOfComments;

            $likes = $this->getNumberOfLikes($p->id_post);
            $p->numberOfLikes = $likes;

            $userSession = session('user');
            // dd($userSession);
            $p->userFromSession = $userSession;
        }
        // dd($posts);

        return $posts;
    }


    public function getPostComment($idPost)
    {
        return DB::table("comments as c")
            ->join("users as u", "c.id_user", "u.id_user")
            ->where("id_post", $idPost)
            ->get();
    }


    public function getNumberOfCommentsForPost($idPost)
    {
        return DB::table("comments")
            ->where("id_post", $idPost)
            ->count();
    }


    public function getNumberOfLikes($idPost)
    {
        return DB::table("likes")
            ->where("id_post", $idPost)
            ->count();
    }


    function getPostsOfUser($idUser)
    {
        // dd(session('user'));
        $posts =  DB::table('posts as p')
            ->join("images as i", "p.id_post", "i.id_post")
            ->where('id_user', $idUser)
            ->orderBy('created_post', 'desc')
            ->get();

        foreach ($posts as $p) {
            $comments = $this->getPostComment($p->id_post);
            $p->comments = $comments;
        }
        // dd($posts);
        return $posts;
    }


    public function deletePost($id)
    {
        return DB::table('posts')
            ->where('id_post', $id)
            ->delete();
    }


    public function getPost($id)
    {
        return DB::table('posts as p')
            ->join('images as i', 'p.id_post', 'i.id_post')
            ->where('p.id_post', $id)
            ->first();
    }
}
