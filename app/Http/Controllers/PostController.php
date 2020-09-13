<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Image;
use App\Models\Post;
use App\Services\PostService;
use App\Services\UploadService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $model;
    private $service;

    public function __construct()
    {
        $this->model =  new Post();
        $this->service = new PostService();
    }

    public function store(PostRequest $request)
    {
        return $this->service->insert($request);
    }


    public function edit($id)
    {
        //forma za editovanje 
        $post = $this->model->getPost($id);
        // dd($post);

        return view('pages.post_edit', ['post' => $post]);
    }


    public function update(PostRequest $request, $id)
    {

        // dd($request->all());
        // dd($request->file('post_img'))
        // $this->service->insert($request, $id);

        //fizicki ce upload na disk
        if ($request->hasFile('post_img')) {
            $uploadService = new UploadService();
            $image = $uploadService->upload($request->file('post_img'), 'posts');

            //update u bazi sliku za zadati id
            try {
                $modelImage = new Image();
                $modelImage->update($id, $image);
            } catch (\Exception $ex) {
                \Log::error($ex->getMessage());
            }
        }

        //update posta u bazu
        try {
            $description = $request->input('post_description');
            $this->model->updatePost($id, $description);
            return redirect()->back()->with('message', "Uspesno izmenjen post");
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('message', "Greska prilikom izmene posta, pokusajte kasnije");
        }
    }



    public function getPostAjax()
    {
        $idUser = session('user')->id_user;

        try {
            $posts = $this->model->postOfUserAndFriends($idUser);
            return response($posts, 200);
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return response(['message' => 'Greska na serveru'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->model->deletePost($id);
            return redirect()->back()->with('message', 'Uspesno izbrisan post');
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with('message', 'Greska na serveru');
        }
    }
}
