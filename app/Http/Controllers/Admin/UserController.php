<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function index(Request $request)
    {
        if ($request->has('user_search')) {
            // dd($request->all());
            $data = $this->model->getAllUsers($request);
            // dd($data);
            $data->appends(['user_search' => $request->get('user_search')])->render();
        } else {
            // dd($request->get('user_search'));
            $data = $this->model->getAllUsers();
        }
        return view("admin.users.table", ['users' => $data]);
    }


    public function destroy($id)
    {
        try {
            $this->model->delete($id);
            return redirect(route("user.index"))->with('message', "Uspesno izbrisan korisnik");
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return redirect(route("user.index"))->with("message", "Greska, proverite log file");
        }
    }
}
