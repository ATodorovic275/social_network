<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Dashboard
{
    ublic function getVisits()
    {
        return DB::table('visit as v')
            ->select('v.*', 'u.username')
            ->join('users as u', 'v.id_user', 'u.id_user')
            ->paginate(10);
    }


    public function getActions()
    {
        return DB::table('actions as a')
            ->select('a.*', 'u.username')
            ->join('users as u', 'a.id_user', 'u.id_user')
            ->paginate(10);
    }p
}
