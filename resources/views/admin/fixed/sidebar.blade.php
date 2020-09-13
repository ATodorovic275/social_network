<aside>
    <div id="sidebar" class="nav-collapse ">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu" id="nav-accordion">
      <p class="centered"><a href="profile.html"><img src="{{asset('/img/users')}}/{{session('user')->profile_img_src}}" class="img-circle" width="80"></a></p>
        <h5 class="centered">{{session('user')->first_name}} {{session('user')->last_name}}</h5>
        {{-- <li class="mt">
          <a class="active" href="index.html">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
            </a>
        </li> --}}
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-desktop"></i>
            <span>Users</span>
            </a>
          <ul class="sub">
            <li><a href="{{route('user.index')}}">Show</a></li>

          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-cogs"></i>
            <span>Navigation</span>
            </a>
          <ul class="sub">
          <li><a href="{{route('navigation.index')}}">Show</a></li>
            <li><a href="{{route("navigation.create")}}">Add</a></li>
          </ul>
        </li>
        <li class="sub-menu">
          <a href="javascript:;">
            <i class="fa fa-cogs"></i>
            <span>Logs</span>
            </a>
          <ul class="sub">
            <li><a href=" {{route('logs_visit')}} ">Visits</a></li>
            <li><a href="{{route('logs_action')}}">Actions</a></li>
          </ul>
        </li>
        
      </ul>
      <!-- sidebar menu end-->
    </div>
  </aside>