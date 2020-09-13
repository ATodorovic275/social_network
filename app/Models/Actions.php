<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Actions
{

    public function actionsUser($action, $id)
    {
        return DB::table('actions')
            ->insert([
                'action' => $action,
                'id_user' => $id
            ]);
    }
}
