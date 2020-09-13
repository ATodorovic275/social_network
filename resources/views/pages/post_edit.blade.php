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
                
               
                <div class="col-lg-6" id='edit_post'>
                    <h3>Edit post</h3>
                    <form action="{{route('post_update',['id'=>$post->id_post])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <span>Description:</span><br>
                        <input type="text" name="post_description" id="" value="{{$post->description}}"><br>
                        <img src=" {{asset('/img/posts')}}/{{$post->src}} " alt=""><br>
                        <span>Change img:</span><br>
                        <input type="file" name="post_img" id=""><br>
                        <input type="submit" value="Edit post">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>             
            </div>
        </div>
    </div>
</div>

@endsection
@section('appendScript')
    <script src="{{ asset("/js/profile.js") }}"></script>

@endsection