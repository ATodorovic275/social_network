<div id="profile_meni_list">
    <ul>
        <li><a href=" {{ url("/user") }}/{{ session('user')->id_user }}">Timeline</a></li>
        <li><a href=" {{url("/user/friends")}} ">Friends</a></li>
        <li><a href="{{route('profile_form',['id'=>session('user')->id_user])}} ">Edit profile</a></li>          
        <div class="clearfix"></div>
    </ul>
</div>