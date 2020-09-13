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
                            
                            // dd($posts);
                        @endphp
                        <a href="#" id="profile_img_link">                          
                            <img src="{{ asset("img/users") }}/{{session('user')->profile_img_src}}" class="img-fluid" alt="">
                        </a>               
                    </div>
                </div>
                <div class="col-lg-6">
                    @php
                        // dd($user);
                    @endphp
                        @include('components.profile_menu')
                   
                </div>
            </div>
        </div>
    </div>
  
    <div id="profile_content">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-3">
                   
                </div>
                <div class="col-lg-6">
                    @if (session()->has('message'))
                        {{session('message')}}
                    @endif
                  <div id="scroll">
                    @foreach ($posts as $p)
                        <div id="post" class="col-side">
                            <div class="content-head">
                            <img src="{{ asset('img/users') }}/{{session('user')->profile_img_src}}" alt="" class="img-fludi float-left" height="50px">
                                <div class="head-title float-left">
                                    <h2> {{session('user')->first_name}} {{session('user')->last_name}} </h2>
                                    <p>Published: {{ $p->created_post }}</p>
                                </div>
                                <div class="float-right post_options">
                                    <a href="{{route('post_delete',['id'=>$p->id_post])}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    <a href="{{route('post_edit',['id'=>$p->id_post])}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>     
                                </div>    
                                <div class="clearfix"></div>
                            </div>
                                <img src="{{ asset('img/posts') }}/{{ $p->src }}" alt="" class="img-fluid post_img">
                            <div class="content-description">
                                <p>{{$p->description}}</p>
                            </div>
                            <div class="like-comments">
                                <div class="like-comments-numb float-left">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    <span>10</span>
                                </div>
                                <div class="like-comments-numb float-left">
                                    <i class="fa fa-comments" aria-hidden="true"></i>
                                    <span>12</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>
                            
                            <ul class="comments">
                                @foreach ($p->comments as $c)
                            <li><img src="{{asset('img/users')}}/{{session('user')->profile_img_src}}" alt="" height="30px"> {{$c->first_name}}  {{ $c->text }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    
                    </div>
                </div>             
            </div>
        </div>
    </div>
</div>
<form id="change_profile_img" action="/user/profile_img" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="user_id" id="user_id" value="{{session('user')->id_user}}">
    <input type="file" name="profile_img_file" id="profile_img_file">
    <input type="submit" id="send_profile_img" value="">
</form>
@endsection
@section('appendScript')
    <script src="{{ asset("/js/profile.js") }}"></script>

@endsection