<div id="profile_meni_list">
    <ul>
        <li><a href=" {{url("/user_profile")}}/{{ session('user_profile')->id_user }}">Timeline</a></li>
        <li><a href=" {{route('user_profile_friends',['id'=>session('user_profile')->id_user])}}">Friends</a></li>
        <div class="clearfix"></div>
    </ul>
</div>