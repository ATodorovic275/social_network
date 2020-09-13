<?php

namespace App\Http\Controllers;

use App\Models\CommentsModel;
use Illuminate\Http\Request;

class Comments extends Controller
{
    public function comments()
    {
        $model = new CommentsModel();
        $comments = $model->getComments();
        // return $comments;
        dd($comments);

        foreach ($comments as $c) {
            $sub = $model->getSub($c->id_comment);
            if (count($sub) != 0) {
                $c->sub_comments = $sub;
            }
        }

        dd($comments);
    }
}
