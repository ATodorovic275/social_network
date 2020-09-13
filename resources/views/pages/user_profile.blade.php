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
                        <a href="#" id="profile_img_link">                          
                            <img src="{{ asset("img/users") }}/{{session('user_profile')->profile_img_src}}" class="img-fluid" alt="">
                        </a>               
                    </div>
                </div>
                <div class="col-lg-6">
                    @php
                        // dd($user);
                    @endphp
                        @include('components.user_profile')
                   
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
                  <div id="scroll">
                    @foreach ($posts as $p)
                        <div id="post" class="col-side">
                            <div class="content-head">
                            <img src="{{ asset('img/users') }}/{{session('user_profile')->profile_img_src}}" alt="" class="img-fludi float-left" height="50px">
                                <div class="head-title float-left">
                                    <h2> {{session('user_profile')->first_name}} {{session('user_profile')->last_name}} </h2>
                                <p>Published: {{ $p->created_post }}</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <img src="{{ asset('img/posts') }}/{{ $p->src }}" alt="" class="img-fluid">
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
                            <div class="like-or-comments">
                                <div class="like-or-comment float-left">
                                    <a href="">
                                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    <span>Like post</span>
                                    </a>
                                </div>
                                <div class="like-or-comment float-left">
                                    <a href="">
                                        <i class="fa fa-comment" aria-hidden="true"></i>
                                        <span>Comment</span>
                                    </a> 
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <hr>
                        </div>
                    @endforeach
                    
                    </div>
                </div>             
            </div>
        </div>
    </div>
</div>

@endsection
@section('appendScript')
    <script src="{{ asset("/js/profile.js") }}"></script>

@endsection