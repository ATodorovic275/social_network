<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Comments
{

    public function insert($text, $idPost, $idUser)
    {
        DB::table("comments")
            ->insert([
                'text' => $text,
                "id_post" => $idPost,
                "id_user" => $idUser
            ]);
    }
}
