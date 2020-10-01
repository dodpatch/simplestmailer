
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">{{__('Home')}}</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('contact.index')}}" class="nav-link">{{__('Contact')}}</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    {{$slot}}
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{Auth::user()->name}}</span>
          <div class="dropdown-divider"></div>
  

          <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              <i class="fas fa-sign-out-alt"></i> {{__('Logout')}}
          </a>

            
          <div class="dropdown-divider"></div>
          <a href="{{route('profile')}}" class="dropdown-item">
            <i class="fas fa-user-cog mr-2"></i>{{__('Profile')}}
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->