<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{



    public function postComment(Request $request)
    {
        // return "Test";
        // dd($request->all());
        $comment = $request->input('comment');
        $idPost = $request->input('idPost');
        $idUser = $request->input('idUser');

        $model = new Comments();
        try {
            $model->insert($comment, $idPost, $idUser);
            return response()->json(null, 200);
        } catch (\PDOException $ex) {
            dd($ex->getMessage());
            return response()->json(['message' => "Greska u bazi"], 500);
        }
    }
}
