<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Logs
{
    public function getVisits()
    {
        return DB::table('visit as v')
            ->select('v.*', 'u.username')
            ->join('users as u', 'v.id_user', 'u.id_user')
            ->paginate(10);
    }


    public function getActions($request = null)
    {
        $query =  DB::table('actions as a')
            ->select('a.*', 'u.username')
            ->join('users as u', 'a.id_user', 'u.id_user');

        if ($request) {
            $query->where('date', $request->get('date_search'));
        }

        return $query->paginate(5);

        // return DB::table('actions as a')
        //     ->select('a.*', 'u.username')
        //     ->join('users as u', 'a.id_user', 'u.id_user')
        //     ->paginate(10);
    }
}
