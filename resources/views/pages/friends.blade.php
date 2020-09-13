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
                        <img src="{{asset("/img/users")}}/{{ session('user')->profile_img_src }}" class="img-fluid" alt="">
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
                @php
                    // dd($friends);
                @endphp
                    
                    @foreach ($friends as $f)
                        <div class="col-lg-3 col-sm-6">
                            <a href="{{route('user_profile',['id'=>$f->id_user])}}">
                                <div class="friend">
                                    <img src="{{asset('img/users')}}/{{$f->profile_img_src}}" class="img-fluid float-left" alt="" width="50px">
                                    <div class="friend_text float-left">
                                        <p>{{$f->first_name}} {{$f->last_name}}</p>
                                        @if ($f->online == 0 )
                                            <p>Offline</p>                                   
                                        @else
                                        <p>Online</p>

                                        @endif
                                        {{-- <p>Friends for: {{$f->date}} </p> --}}
                                    </div>
                                    <a href="{{route('friend_delete',['id'=>$f->id_user])}}" class="float-left"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

