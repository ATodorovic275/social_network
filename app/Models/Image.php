<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Image
{
    public function insert($idPost, $image)
    {

        // dd($image);
        DB::table("images")
            ->insert([
                "src" => $image['file_name'],
                'alt' => $image['alt'],
                'id_post' => $idPost
            ]);
    }


    public function update($idPost, $image)
    {
        return DB::table("images")
            ->where('id_post', $idPost)
            ->update([
                "src" => $image['file_name'],
                'alt' => $image['alt']
            ]);
    }
}
