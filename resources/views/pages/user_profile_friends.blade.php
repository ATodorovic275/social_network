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
                        <a href="#">
                        <img src="{{asset("/img/users")}}/{{session('user_profile')->profile_img_src }}" class="img-fluid" alt="">
                        </a>
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    
                    @include('components.user_profile')

                   
                </div>
            </div>
        </div>
    </div>
  
    <div id="profile_content">
        <div class="container">
            <div class="row">
                @php
                    // dd($friends);
                @endphp
                    
                    @foreach ($friends as $f)
                            <div class="col-lg-3 col-sm-6">
                    
                                @if ($f->id_user != session('user')->id_user)
                                    <a href=" {{route('user_profile',['id'=>$f->id_user])}} ">

                                @else
                                    <a href=" {{route('user',['id'=>$f->id_user])}} ">
                                    
                                @endif

                                <div class="friend">
                                    <img src="{{asset('img/users')}}/{{$f->profile_img_src}}" class="img-fluid float-left" alt="" width="50px">
                                    <div class="friend_text float-left">
                                        <p>{{$f->first_name}} {{$f->last_name}}</p>                                    
                                    </div>
                                    <div class="clearfix"></div>
                                </div>  
                    </a>

                        </div>
                    @endforeach
        
                       
            </div>
        </div>
    </div>
</div>
@endsection

