
@include('inc.loginmodals')
  
<nav class="white" role="navigation">
    <div class="navbar-fixed container">
      <a id="logo-container" href="{{ route('dashboard') }}" @guest class="brand-logo left" @else class="brand-logo" @endguest>Logo</a>
      <!-- GUEST -->
      @guest    
      <ul class="right">                  
        <li><a href="#section1" class="hide-on-small-only">Section 1</a></li>
        <li><a href="#section2" class="hide-on-small-only">Section 2</a></li>
        <li><a class="waves-effect waves-light btn teal modal-trigger" href="#registerModal">Join</a></li>
        <li><a class="waves-effect waves-light btn white teal-text modal-trigger" href="#loginModal">Log In</a></li>
      </ul>
      <!-- USER -->
      @else          
        <ul class="right hide-on-med-and-down">
            <li>
                <a class="btn" href="{{ route('logout') }}" onclick="event.preventDefault();        document.getElementById('logout-form').submit();">Logout</a>   
                <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">         
                  @csrf
                </form>
              </li>
        </ul>      
        <a href="#" data-activates="nav-mobile" class="button-collapse teal-text"><i class="material-icons">menu</i></a>   
        @endguest
    </div>
</nav>

<!-- SIDENAV -->
@auth
<ul id="nav-mobile" class="side-nav">
  <li>
    <a class="waves-effect teal white-text" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="waves-effect">Logout</a>      
  </li>
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">                    
    @csrf
</form>
@endauth