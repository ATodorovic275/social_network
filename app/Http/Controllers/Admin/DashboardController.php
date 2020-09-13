<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $data;

    public function index()
    {
        $model = new Dashboard();
        $data['visits'] = $model->getVisits();
        $data['actions'] = $model->getActions();

        // dd($visits);

        return view('admin.dashboard.dash', $data);
    }
}
