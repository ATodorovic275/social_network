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
                    <div id="profile_meni_list">
                        <ul>
                            <li><a href=" {{route('add_friend',['id'=>session('user_profile')->id_user])}}">Add friend</a></li>
                            <div class="clearfix"></div>
                        </ul>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
  
    <div id="profile_content">
        <div class="container">
            <div class="row">
                
                <h3>Add to friends to see posts</h3>            
            </div>
        </div>
    </div>
</div>

@endsection
@section('appendScript')
    <script src="{{ asset("/js/profile.js") }}"></script>

@endsection