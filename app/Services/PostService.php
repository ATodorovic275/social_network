<?php


namespace App\Services;

use App\Http\Requests\PostRequest;
use App\Models\Image;
use App\Models\Post;
use App\Services\UploadService;
use Illuminate\Support\Facades\DB;

class PostService
{
    private $model;

    public function __construct()
    {
        $this->model = new Post();
    }

    public function insert($request)
    {
        $uploadedImage = $this->uploadImage($request);
        // dd($uploadedImage);

        $this->model = new Post();
        // dd($request->all());
        DB::beginTransaction();
        try {
            $idPost = $this->model->insert($request);
            // dd($idPost);
            $this->insertImage($idPost, $uploadedImage);
            DB::commit();
            return redirect('/');
        } catch (\PDOException $ex) {
            dd($ex->getMessage());
            DB::rollBack();
        }
    }


    public function insertImage($idPost, $image)
    {
        $model = new Image();
        $model->insert($idPost, $image);
    }


    public function uploadImage($request)
    {
        $image = $request->file('post_img');
        // if ($image->isValid()) {
        //     dd($image);
        // }
        // dd($image);
        $service = new UploadService();
        return $service->upload($image, "posts");
    }
}
