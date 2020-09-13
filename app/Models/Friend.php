<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Friend
{

    public function getSugestedFriendsForUser($idUser)
    {
        // dd($idUser);
        // return DB::table('user')
        //     ->select("id", 'first_name', "last_name")
        //     ->where('user.id', "!=", $idUser)
        //     ->whereNotExists(function ($query) {
        //         $query->select(DB::raw(1))
        //             ->from('friends')
        //             ->whereRaw("id_friend1 = 1") // promeni
        //             ->whereRaw("id_friend2 = user.id");
        //     })
        //     ->inRandomOrder()
        //     ->limit('2')
        //     ->get();

        return DB::select("SELECT * from users where users.id_user != $idUser AND not EXISTS(SELECT * from friends where id_friend1 = $idUser AND id_friend2 = users.id_user ) order by rand() limit 2");


        // DB::table('users')
        //         ->whereExists(function($query)
        //         {
        //             $query->select(DB::raw(1))
        //                   ->from('orders')
        //                   ->whereRaw('orders.user_id = users.id');
        //         })
        //         ->get();
    }


    public function getOnlineFriends($idUser)
    {
        return DB::table('users')
            ->join('friends', 'users.id_user', 'friends.id_friend2')
            ->select('users.first_name', "users.last_name", "users.profile_img_src", "users.profile_img_alt")
            ->where("friends.id_friend1", $idUser)
            ->where('users.online', '1') //promeni na 1
            ->get();
    }


    public function getFriendsOfUser($idUser)
    {
        return DB::table("users as u")
            ->join("friends as f", "u.id_user", "f.id_friend2")
            ->where("f.id_friend1", $idUser)
            ->get();
    }


    public function store($idSugestion, $idUser)
    {
        //insert friend
        return DB::table('friends')
            ->insert([
                ['id_friend1' => $idSugestion, 'id_friend2' => $idUser],
                ['id_friend1' => $idUser, 'id_friend2' => $idSugestion]
            ]);
    }


    public function deleteFriend($id)
    {
        // dd($id);
        DB::table('friends')
            ->where('id_friend1', $id)
            ->delete();

        DB::table('friends')
            ->where('id_friend2', $id)
            ->delete();
    }


    public function checkIfIsFriend($id, $idFriend)
    {
        return DB::table('friends')
            ->where('id_friend1', $id)
            ->where('id_friend2', $idFriend)
            ->first();
    }
}
