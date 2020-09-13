<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    private $model;
    public function __construct()
    {
        $this->model = new Like();
    }

    public function add(Request $request)
    {
        // dd($request->all());
        $idPost = $request->input('idPost');
        $idUser = $request->input('idUser');

        $exist = $this->model->existLike($idPost, $idUser);
        // dd($exist);

        try {
            if (!$exist) {
                $this->model->likePost($idPost, $idUser);
            } else {
                //obrise se like za taj post
                $this->model->deletePost($idPost, $idUser);
            }
            return response(['message' => 'uspesno'], 200);
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return response(['message' => 'Greska na serveru'], 500);
        }
    }
}
