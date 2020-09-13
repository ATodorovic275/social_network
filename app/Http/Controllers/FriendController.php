<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FriendController extends Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Friend();
    }

    public function addFriendAjax(Request $request)
    {
        // return dd($request->all());
        $idSugestion = $request->input('idSugestion');
        $idUser = $request->input('idUser');

        try {
            $this->model->store($idSugestion, $idUser);
            return response(null, 200);
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return response(['message' => 'Greska na serveru'], 500);
        }
    }


    public function addFriend($id)
    {

        $idUser = session('user')->id_user;

        try {
            $this->model->store($id, $idUser);
            return redirect()->back();
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            // return response(['message' => 'Greska na serveru'], 500);

        }
    }


    public function destroy($id)
    {
        try {
            $this->model->deleteFriend($id);
            return redirect()->back();
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            dd($ex->getMessage());
        }
    }



    public function userProfileFriends($id)
    {
        $model = new Friend();
        $friends = $model->getFriendsOfUser($id);
        // dd($friends);
        return view("pages.user_profile_friends", ['friends' => $friends]);
    }
}
