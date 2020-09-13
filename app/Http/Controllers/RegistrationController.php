<?php

namespace App\Http\Controllers;

use App\Models\Actions;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "first_name" => "required|regex:/^[A-Z]{1}[a-z]+$/",
            "last_name" => "required|regex:/^[A-Z]{1}[a-z]+$/",
            "email" => ["required", "email", "regex:/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/"],
            "username" => "required|regex:/^[\w!@#$%^&*]+$/",
            "password" => "required|regex:/\d+/|regex:/[a-z]+/|regex:/[!@#$%%^&*?]+/",
        ]);

        if ($validator->fails()) {
            // return redirect('/registration')
            //     ->withErrors($validator, "registration");
            return response()->json(["errors" => $validator->errors()->all()], 422);
        }

        //insert into database
        // dd($request);
        $model = new User();
        try {
            $id = $model->insertUser($request->input("first_name"), $request->input("last_name"), $request->input("username"), $request->input("email"), md5($request->input("password")));

            $modelAction = new Actions();
            $modelAction->actionsUser('register', $id);
        } catch (\PDOException $ex) {
            \Log::error($ex->getMessage());
            return response(['greska' => "Greska prilikom registracija, pokusajte kasnije"], 500);
        }
    }
}
