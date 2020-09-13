<body>
    <header>
        <div class="container">

      <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand" href="#">Friends</a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="ml-5 navbar-nav mr-auto">
            <li class="nav-item">
            <a class="nav-link" href="{{ url("/") }}"
                >Home <span class="sr-only">(current)</span></a
              >
            </li>
           
            @if (session()->has("user"))
              <li class="nav-item">               
              <a class="nav-link" href="{{ url("/user") }}/{{ session('user')->id_user }}">{{ session()->get('user')->username }}</a>                   
              </li>
              @if (session('user')->id_role == '2')
              <li class="nav-item">
                <a class="nav-link" href="{{route('user.index')}}">Admin</a>
              </li>
              @endif
              <li class="nav-item">
                <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
              </li>
            @endif
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input id="search_user"
              class="form-control mr-sm-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button 
              class="btn btn-outline-success my-2 my-sm-0"
              type="submit"
            >
              Search
            </button>
          </form>
          


        </div>
        </div>
      </nav>
    </header>
    <div id="search_users_list">
      
    </div>