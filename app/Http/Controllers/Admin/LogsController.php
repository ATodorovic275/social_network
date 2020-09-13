<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logs;
use Illuminate\Http\Request;

class LogsController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new Logs();
    }

    public function visits()
    {
        $data['visits'] = $this->model->getVisits();

        // dd($visits);

        return view('admin.logs.visits', $data);
    }


    public function actions(Request $request)
    {
        if ($request->has('date_search')) {
            $data = $this->model->getActions($request);
            // dd($request->get('date_search'));
            $data->appends(['date_search' => $request->get('date_search')])->render();
        } else {
            $data = $this->model->getActions();
        }

        return view('admin.logs.actions', ['actions' => $data]);
    }
}
