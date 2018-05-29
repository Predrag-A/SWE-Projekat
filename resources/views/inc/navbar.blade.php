
@guest
@include('inc.loginmodals')
@endguest

<div class="navbar-fixed">
  <nav>
    <div class="nav-wrapper container">
      <a id="logo-container" href="{{route('dashboard')}}" @guest class="brand-logo left" @else class="brand-logo" @endguest>{{config('app.name', 'INT')}}</a>
      <!-- GOST -->
      @guest    
      <ul class="right">                  
        <li><a class="waves-effect waves-light btn modal-trigger" href="#registerModal">Registracija</a></li>
        <li><a class="waves-effect waves-light btn white blue-text text-darken-4 modal-trigger" href="#loginModal">Prijava</a></li>
      </ul>
      <!-- KORISNIK -->
      @else          
        <ul class="right hide-on-med-and-down">          
          <li><a href="{{route('korisnici')}}" class="waves-effect">Korisnici</a></li>
          <li><a href="{{route('dogadjaji')}}" class="waves-effect">Događaji</a></li>
          <li><a href="#" class="waves-effect"><i class="material-icons">notifications</i></a></li>
          <li><a href="#" class="dropdown-trigger" data-target="dropdown">
            <img style="height:36px; position: relative; top:14px;" class="circle" src="{{route('index')}}/storage/avatars/{{Auth::user()->user_img}}">
            {{Auth::user()->first_name}} {{Auth::user()->last_name}}
            <i class="material-icons right">arrow_drop_down</i>
          </a></li>
        </ul>      
        <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>   
        @endguest
    </div>
  </nav>
</div>

@auth
<!-- SIDENAV -->
<ul id="slide-out" class="sidenav">
  <li><div class="user-view">
    <div class="background">
      <img src="{{asset('img/background3.jpg')}}" alt="">      
    </div>
    <div><img class="circle" src="{{route('index')}}/storage/avatars/{{Auth::user()->user_img}}"></div>    
    <div class="white-text name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
    <div class="white-text email">{{Auth::user()->email}}</div>
    <div class="divider"></div>
    <div class="white-text">{{Auth::user()->status}}</div>
  </div></li>
  <li><a href="{{route('korisnici')}}/{{Auth::user()->id}}" class="waves-effect">Moj profil</a></li>
  <li><a href="#" class="waves-effect">Notifikacije </a></li>
  <li><a href="{{route('korisnici')}}" class="waves-effect">Korisnici</a></li>
  <li><a href="{{route('dogadjaji')}}" class="waves-effect">Događaji</a></li>
  <li><a class="waves-effect" href="{{route('dashboard')}}">Početna strana</a></li>
  <li>
    <a class="waves-effect blue darken-4 white-text" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="waves-effect">Odjavite se</a>      
  </li>  
</ul>

<!-- DROPDOWN -->
<ul id="dropdown" class="dropdown-content">
  <li><a href="{{route('korisnici')}}/{{Auth::user()->id}}">Moj profil</a></li>
  <li><a href="{{route('dashboard')}}">Početna strana</a></li>
  <li class="divider" tabindex="-1"></li>
  <li><a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="waves-effect">Odjavite se</a></li>
</ul>

<!-- LOGOUT -->
<form id="logout-form" action="{{route('logout')}}" method="post" style="display: none;">                    
    @csrf
</form>
@endauth