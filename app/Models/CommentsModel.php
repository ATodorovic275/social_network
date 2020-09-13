<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class CommentsModel
{
    public function getComments()
    {
        return DB::table('comments')->get();
    }


    public function getSub($id)
    {
        return DB::table('comments')->where("id_parent", $id)->get();
    }
}
