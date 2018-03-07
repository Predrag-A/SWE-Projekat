
@include('inc.loginmodals')
  
<div class="navbar-fixed">
  <nav class="white">
    <div class="nav-wrapper container">
      <a id="logo-container" href="{{ route('dashboard') }}" @guest class="brand-logo left" @else class="brand-logo" @endguest>{{config('app.name', 'INT')}}</a>
      <!-- GUEST -->
      @guest    
      <ul class="right">                  
        <li><a class="waves-effect waves-light btn teal modal-trigger" href="#registerModal">Join</a></li>
        <li><a class="waves-effect waves-light btn white teal-text modal-trigger" href="#loginModal">Log In</a></li>
      </ul>
      <!-- USER -->
      @else          
        <ul class="right hide-on-med-and-down">
            <li>
                <a class="btn" href="{{ route('logout') }}" onclick="event.preventDefault();        document.getElementById('logout-form').submit();">Log out</a>  
              </li>
        </ul>      
        <a href="#" data-activates="nav-mobile" class="button-collapse teal-text"><i class="material-icons">menu</i></a>   
        @endguest
    </div>
  </nav>
</div>

<!-- SIDENAV & LOGOUT -->
@auth
<ul id="nav-mobile" class="side-nav">
  <li>
    <a class="waves-effect teal white-text" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="waves-effect">Log out</a>      
  </li>
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">                    
    @csrf
</form>
@endauth