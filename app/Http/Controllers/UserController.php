<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Post;
use App\Models\User;
use App\Rules\Password;
use App\Services\UploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function profile(Request $request)
    {
        $user = $this->model->getUserProfileInformation($request);
        // dd($user);
        return view("pages.profile", ['user' => $user]);
    }


    public function users(Request $request)
    {
        $name =  $request->input('name');
        try {
            $users = $this->model->getUsers($name);
            return response($users, 200);
        } catch (\PDOException $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }


    public function show($id)
    {
        $model = new Post();

        $data['posts'] = $model->getPostsOfUser($id);

        // dd($data);
        return view('pages.profile', $data);
    }


    public function friends()
    {
        $model = new Friend();
        $friends = $model->getFriendsOfUser(session()->get('user')->id_user);
        // dd($friends);
        return view("pages.friends", ['friends' => $friends]);
    }


    public function userForm($id)
    {
        // dd($id);
        $user = $this->model->getOneUser($id);
        // dd($user);
        return view("pages.edit_profile", ['user' => $user]);
    }


    public function edit(Request $request, $id)
    {
        // dd($request->all());

        $rules = [
            'first_name' => 'required|alpha|min:2|max:20',
            'last_name' => 'required|alpha|min:2|max:20',
            'email' => 'required|email',
            'username' => 'required',
        ];

        //ukoliko se vrzi izmena passworda
        if ($request->input('password') != null) {
            $rules['password'] = "required|regex:/\d+/|regex:/[a-z]+/|regex:/[!@#$%%^&*?]+/";
        }

        // dd($rules);

        $validator = \Validator::make($request->all(), $rules);
        $validator->validate();


        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $username = $request->input('username');
        $email = $request->input('email');
        // $password = $request->input('password');
        $profileImg = $request->file('edit_profile_img');

        try {
            //ubaci id user
            $this->model->updateUser($id, $firstName, $lastName, $username, $email);

            //resetovati sesiju
            $user = $this->model->updateSession($id);
            session()->put("user", $user);

            return redirect()->back()->with("message", "Uspesno ste izmenili informacije");
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect()->back()->with("message", "Doslo je do greske pokusajte kasnije");
            // dd($ex->getMessage());
        }

        // return view("pages.edit_profile");
    }

    public function editProfileImage(Request $request)
    {
        // dd($request->all());
        $resource = new UploadService();
        $image = $resource->upload($request->file('profile_img_file'), "users");
        $idUser = $request->input('user_id');
        // dd($image);

        try {
            $model = new User();
            $model->updateProfileImage($image, $idUser);

            //resetovati sesiju
            $user = $model->updateSession($idUser);
            session()->put("user", $user);

            return redirect()->back();
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            // dd($ex->getMessage());
        }
    }


    public function userProfile($id)
    {

        //da li su prijatelji
        $modelFriends = new Friend();
        $friends = $modelFriends->checkIfIsFriend($id, session('user')->id_user);
        // dd($id);
        // dd(session('user')->id_user);
        // dd($friends);
        $modelUser = new User();
        $user = $modelUser->getOneUser($id);
        session()->put("user_profile", $user);

        if ($friends) {
            $model = new Post();
            $data['posts'] = $model->getPostsOfUser($id);
            return view("pages.user_profile", $data);
        }



        return view("pages.user_profile_not_friends");
        //ukoliko su prijatelji

        // dd($data);
    }
}
