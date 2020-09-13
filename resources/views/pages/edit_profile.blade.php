@extends('layouts.layout')

@section('content')
<div id="background">
  
</div>
<div id="profile_main">
    <div id="profile_menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div id="profile_img">
                        @php
                            // dd(session()->all());
                        @endphp
                        <a href="#" id="profile_img_link">                          
                            <img src="{{ asset("img/users") }}/{{session('user')->profile_img_src}}" class="img-fluid" alt="">
                        </a>               
                    </div>
                </div>
                <div class="col-lg-6">
                    @include('components.profile_menu')

                   
                </div>
            </div>
        </div>
    </div>
  
    <div id="profile_content">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-5">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Edit profile information</h3>
                            </div> 
                           @if (session()->has('message'))
                               {{session('message')}}
                           @endif          
                        </div>
                        <div class="form-bottom">
                        <form role="form" action="{{ route("edit_profile",['id'=>session('user')->id_user]) }}" method="post" class="registration-form">
                            @csrf
        
                                <div class="form-group">
                                    <label class="sr-only" for="form-first-name">First name</label>
                                    <input type="text" value=" {{$user->first_name}} " id="first_name" name="first_name" placeholder="First name..." class="form-first-name form-control" id="first-name">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-last-name">Last name</label>
                                    <input type="text" value=" {{$user->last_name}} " id="last_name" name="last_name" placeholder="Last name..." class="form-last-name form-control" id="last-name">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-email">Email</label>
                                    <input type="text" value=" {{$user->email}} " id="email" name="email" placeholder="Email..." class="form-email form-control" id="email">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-email">Username</label>
                                    <input type="text" value=" {{$user->username}} " id="username" name="username" placeholder="Username..." class="form-email form-control" id="reg_username">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="form-email">New password</label>
                                    <input type="text" id="password" name="password" placeholder="New password" class="form-email form-control" id="reg_password">
                                </div>
                                <div class="form-group">
                                    <label class="image_label" for="form-email">Profile image</label>
                                    <input type="file" name="edit_profile_img" id="edit_profile_img">
                                </div>
                                    <input type="submit" value="Edit profile" class="btn" id="btn_edit_profile">

                                
                            </form>
                            <div id="reg_error" class="">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                          
            </div>
        </div>
    </div>
</div> 

@endsection