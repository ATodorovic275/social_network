@extends('layouts.layout')
@section('content')
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="col-side">
                    <h2>Online friends</h2>
                    <hr>
                    @php
                        // dd(session()->all());
                    @endphp
                    @if (count($onlineFriends) != 0)
                        @foreach ($onlineFriends as $on)
                            <div class="col-side-body">
                                <img src="{{ asset('img/users') }}/{{$on->profile_img_src}}" class="img-fluid float-left" alt="" width="50px">
                                <div id="name" class="float-left">
                                    <p>{{$on->first_name}} {{$on->last_name}}</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        @endforeach                 
                    @else
                        <p>No online friends</p>

                    @endif
                    
                </div>
            </div>
            <div class="col-lg-6">
                
                <div id="scroll">
                    <div id="make_post">
                    <h3>New post</h3>

                        <form action="{{ url("/posts") }}" method="post" enctype="multipart/form-data">
                            @csrf
                                <span>Description:</span>
                              <textarea name="post_description" id="post_description" cols="30" rows="3"></textarea><br>
                              <span>Picture</span><br>
                              <input type="file" name="post_img" id="post_img"><br>
                              <input type="submit" value="Post">
                          </form>
                    </div>


                    
  <!-- Modal -->
  {{-- <div class="" id="" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="">Add new post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ url("/posts") }}" method="post" enctype="multipart/form-data">
            @csrf
              <textarea name="post_description" id="post_description" cols="30" rows="3"></textarea>
              <input type="file" name="post_img" id="post_img"><br>
              <input type="submit" value="Post">
          </form>
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
  </div> --}}


            @foreach ($posts as $p)
                <div id="post" class="col-side">
                    <div class="content-head">
                        <img src="{{ asset('img/users')}}/{{$p->profile_img_src}}" alt="" class="img-fludi float-left" height="50px">
                        <div class="head-title float-left">
                            @if ($p->id_user != session('user')->id_user)
                                <a href=" {{route('user_profile',['id'=>$p->id_user])}} "><h2>{{ $p->first_name }} {{ $p->last_name }}</h2></a>
                            @else
                                 <a href=" {{route('user',['id'=>$p->id_user])}} "><h2>{{ $p->first_name }} {{ $p->last_name }}</h2></a>
                            @endif
                            <p>Published: {{ $p->created_post }}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <img src="{{ asset('img/posts') }}/{{ $p->src }}" alt="" class="img-fluid post_img">
                    <div class="content-description">
                        <p>{{ $p->description }}</p>
                    </div>
                    <div class="like-comments">
                        <div class="like-comments-numb float-left">
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            <span>{{ $p->numberOfLikes }}</span>
                        </div>
                        <div class="like-comments-numb float-left">
                            <i class="fa fa-comments" aria-hidden="true"></i>
                        <span>{{ $p->numberOfComments }}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <hr>
                    <div class="like-or-comments">
                    <div class="like-or-comment float-left">
                        <a href="#" class="like" data-id-post='{{$p->id_post}}' data-id-user='{{$p->userFromSession->id_user}}'>
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        <span>Like post</span>
                        </a>
                    </div>
                    <div class="like-or-comment float-left">
                        {{-- <a href="">
                            <i class="fa fa-comment" aria-hidden="true" data-id={{$p->id_post}}>Comment</i>                            
                        </a>  --}}
                        <i class="fa fa-comment" aria-hidden="true"></i>
                        <span class="comment" data-id={{$p->id_post}}>Comment</span>           
                    </div>
                    <div class="clearfix"></div>
                    </div>
                    <ul class="comments">
                    @foreach ($p->comments as $c)
                        <li><img src="{{asset('img/users')}}/{{$c->profile_img_src}}" alt="" height="30px"> {{$c->first_name}} {{$c->last_name}}  {{ $c->text }}</li>
                    @endforeach
                </ul>
                    <hr>
                    <img src="{{ asset('img/users')}}/{{$p->userFromSession->profile_img_src}}" alt="" class="img-fludi float-left" height="30px">

                <form action="" method="post">
                        <input type="hidden" name="post_id" id="post_id" value="{{$p->id_post}}">
                        <input type="hidden" name="user_id" id="user_id" value="{{$p->userFromSession->id_user}}">
                        <input type="text" name="comment" id="comment" class="comment_input">
                        <input type="button" value="Send" class="post_comment" name="post_comment">
                    </form>
                </div>
                
            @endforeach
            
                </div>
            </div>
            <div class="col-lg-3">
                <div class="col-side">
                    <h2>Add peoples</h2>
                    <hr>
                    @php
                        // dd($friendsSugestion);
                    @endphp


                    @foreach ($friendsSugestion as $f)
                    <div class="col-side-body">
                    <img src="{{ asset('img/users') }}/{{$f->profile_img_src}}" class="img-fluid float-left" alt="" width="50px">
                        <div id="name" class="float-left">
                        <p>{{$f->first_name}} {{ $f->last_name}}</p>
                        </div>
                        <a href="#" class="float-left add-friend" data-id-sugestion={{$f->id_user}} data-id-user={{session('user')->id_user}}>Add</a>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach
                    
                                    
                </div>                
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->

@endsection
@section('appendScript')
    <script src="{{ asset("/js/comments.js") }}"></script>

@endsection