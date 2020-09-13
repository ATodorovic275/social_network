<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "HomeController@index")->middleware("login");


// Route::get('/profile', "UserController@profile"); // ovo se ne koristi izgleda kao ni metoda


Route::get('/registration', function () {
    return view('registration');
});

Route::post("/doLogin", "LoginController@doLogin2")->name("doLogin");
Route::post("/doRegist", "RegistrationController@register")->name("doRegist");


Route::get("/logout", "LoginController@logout")->name('logout');

// Route::get('/com', "Comments@comments"); // proveriti ovo
Route::post('/posts', "PostController@store");
Route::get('/posts_ajax', "PostController@getPostAjax");
Route::get('post/{id}/destroy', 'PostController@destroy')->name('post_delete');
Route::get('post/{id}/edit', 'PostController@edit')->name('post_edit');
Route::post('post/{id}/update', 'PostController@update')->name('post_update');


Route::get("/user/friends", "UserController@friends");

Route::get("/user/{id}", "UserController@show")->name('user');
Route::get("/user/{id}/edit", "UserController@userForm")->name('profile_form');
Route::post("/user/profile_img", "UserController@editProfileImage");
Route::post('/user/{id}/edit', "UserController@edit")->name('edit_profile');

//ako su prijatelji
Route::get("/user_profile/{id}", "UserController@userProfile")->name('user_profile');
Route::get("/user_profile/{id}/friends", "FriendController@userProfileFriends")->name('user_profile_friends');



//friends
Route::get('/friend/{id}/delete', "FriendController@destroy")->name('friend_delete');
Route::get("/add_friend/{id}", "FriendController@addFriend")->name('add_friend');




//admin
Route::group(['middleware' => 'admin'], function () {
    Route::get("/admin/visits", "Admin\LogsController@visits")->name('logs_visit');
    Route::get("/admin/actions", "Admin\LogsController@actions")->name('logs_action');

    Route::get("/admin/user", "Admin\UserController@index")->name('user.index');
    Route::get("/admin/user/{id}/delete", "Admin\UserController@destroy");

    Route::get("/admin/navigation/create", "Admin\NavigationController@create")->name("navigation.create");
    Route::post("/admin/navigation", "Admin\NavigationController@store")->name("navigation.store");
    Route::get("/admin/navigation", "Admin\NavigationController@index")->name("navigation.index");
});
