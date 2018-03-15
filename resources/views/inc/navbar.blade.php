
@include('inc.loginmodals')
  
<div class="navbar-fixed">
  <nav class="white">
    <div class="nav-wrapper container">
      <a id="logo-container" href="{{route('dashboard')}}" @guest class="brand-logo left" @else class="brand-logo" @endguest>{{config('app.name', 'INT')}}</a>
      <!-- GUEST -->
      @guest    
      <ul class="right">                  
        <li><a class="waves-effect waves-light btn blue darken-4 modal-trigger" href="#registerModal">Join</a></li>
        <li><a class="waves-effect waves-light btn white blue-text text-darken-4 modal-trigger" href="#loginModal">Log In</a></li>
      </ul>
      <!-- USER -->
      @else          
        <ul class="right hide-on-med-and-down">          
          <li><a href="#" class="waves-effect">Events</a></li>
          <li><a href="#" class="dropdown-button" data-activates="dropdown"><img style="height:36px; position: relative; top:14px;" class="circle" src="{{asset('img/account-ph.jpg')}}"><i class="material-icons right">arrow_drop_down</i></a></li>
        </ul>      
        <a href="#" data-activates="nav-mobile" class="button-collapse blue-text text-darken-4"><i class="material-icons">menu</i></a>   
        @endguest
    </div>
  </nav>
</div>

@auth
<!-- SIDENAV -->
<ul id="nav-mobile" class="side-nav">
  <li><div class="user-view">
    <div class="background">
      <img src="{{asset('img/background3.jpg')}}" alt="">      
    </div>
    <div><img class="circle" src="{{asset('img/account-ph.jpg')}}"></div>    
    <div class="white-text name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
    <div class="white-text email">{{Auth::user()->email}}</div>
    <div class="divider"></div>
    <div class="white-text">{{Auth::user()->status}}</div>
  </div></li>
  <li><a href="#" class="waves-effect">Profile</a></li>
  <li><a href="#" class="waves-effect">Events</a></li>
  <li><a class="waves-effect" href="{{route('dashboard')}}">Dashboard</a></li>
  <li>
    <a class="waves-effect blue darken-4 white-text" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="waves-effect">Log Out</a>      
  </li>  
</ul>

<!-- DROPDOWN -->
<ul id="dropdown" class="dropdown-content">
    <li><a href="#">Profile</a></li>
    <li><a href="{{route('dashboard')}}">Dashboard</a></li>
    <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="waves-effect">Log Out</a></li>
</ul>

<!-- LOGOUT -->
<form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">                    
    @csrf
</form>
@endauth