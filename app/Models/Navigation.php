<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Navigation
{

    public function insert($path, $name, $position)
    {
        return DB::table('navigation')
            ->insert([
                'href' => $path,
                'name' => $name,
                'position' => $position
            ]);
    }


    public function getNav()
    {
        return DB::table('navigation')->get();
    }
}
