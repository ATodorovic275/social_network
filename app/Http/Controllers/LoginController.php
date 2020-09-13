<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationReguest;
use App\Models\Actions;
use App\Models\Login;
use Illuminate\Http\Request;
use Session;
use Validator;

class LoginController extends Controller
{

    private $model;

    // public function __construct(Login $model)
    // {
    //     $this->model = $model;
    // }

    // public function doLogin(LoginRequest $request)
    // {
    //     //data
    //     $username = $request->input("username");
    //     $password = $request->input("password");

    //     // dd($request);

    //     // $user = $this->model->getUser($username, $password);

    //     // if ($user) {
    //     // } else {
    //     // }
    //     return redirect("/");
    // }


    public function doLogin2(Request $request)
    {

        // validate incoming request
        // dd($request->all());
        $messages = [
            'username.required' => 'Username je obavezno polje',
            'password.required' => "Password je obavezno polje"
        ];

        $validator = Validator::make($request->all(), [
            "username" => "required|regex:/^[\w!@#$%^&*]+$/",
            "password" => "required|regex:/\d+/|regex:/[a-z]+/|regex:/[!@#$%%^&*?]+/",
        ], $messages);

        if ($validator->fails()) {
            // return redirect('/registration')
            //     ->withErrors($validator, "login");
            return response()->json(['errors' => $validator->errors()->all()], 422);
        } else {
            //get user
            $model = new Login();
            // dd($request->all());
            $user = $model->getUser($request->input('username'), md5($request->input('password')));
            // dd($user);
            if ($user) {
                //ukoliko postoji korisnik
                $request->session()->put("user", $user);

                $modelAction = new Actions();
                $modelAction->actionsUser('login', $user->id_user);


                return response(['message' => "Uspesno logovanje"], 200);
            } else {
                return response(['message' => "Ne postoji korisnik"], 422);
            }
            // dd($user);

        }
    }


    public function logout(Request $request)
    {
        $modelAction = new Actions();
        $modelAction->actionsUser('logout', session('user')->id_user);

        $request->session()->forget('user');
        $request->session()->flush();


        return redirect("/registration");
    }
}
