<?php

namespace app\Models;

use DB;

class Login
{

    public function getUser($username, $password)
    {
        return DB::table('users')
            // ->select('id', 'username')
            ->where([
                ['username', $username],
                ['password', $password]
            ])->first();
    }
}
