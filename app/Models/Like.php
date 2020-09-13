<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Like
{
    public function likePost($idPost, $idUser)
    {
        return DB::table('likes')
            ->insert([
                'id_post' => $idPost,
                'id_user' => $idUser
            ]);
    }


    public function existLike($idPost, $idUser)
    {
        return DB::table('likes')
            ->where([
                ['id_post', $idPost],
                ['id_user', $idUser]
            ])->first();
    }


    public function deletePost($idPost, $idUser)
    {
        return DB::table('likes')
            ->where([
                ['id_post', $idPost],
                ['id_user', $idUser]
            ])->delete();
    }
}
