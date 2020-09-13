<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //prikaz postova, prijatelja online i sugestije za prijatelja

        //sugestije
        // dd(session()->all());
        $modelFriend = new Friend();
        $idUser = session("user")->id_user;
        $friendsSugestion = $modelFriend->getSugestedFriendsForUser($idUser);
        // dd($friendsSugestion);
        $data['friendsSugestion'] = $friendsSugestion;

        //online prijatelji
        $onlineFriends = $modelFriend->getOnlineFriends($idUser);
        // dd($onlineFriends);
        $data['onlineFriends'] = $onlineFriends;

        $modelPost = new Post();
        $posts = $modelPost->postOfUserAndFriends($idUser);
        // dd($posts);
        $data['posts'] = $posts;

        return view('pages.main', $data);
    }
}
