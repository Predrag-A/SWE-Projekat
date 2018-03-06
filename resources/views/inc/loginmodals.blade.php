<!-- LOGIN -->
<div id="loginModal" class="modal">       
  <form class="modal-content col s12" action="{{ route('login') }}" method="post">
    @csrf
    <div class="row center">
      <h4>Log in to INT</h4>        
      <div class="divider"></div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <input name="email" type="email">
        <label for="email">Email</label>
      </div>
      <div class="input-field col s12">
        <input name="password" type="password">
        <label for="password">Password</label>
      </div>         
      <div class="col s12 right-align">
        <a href="#">Forgot password?</a>
      </div>
    </div>
    <div class="row center-align">
      <button class="btn s12 teal waves-effect waves-light" type="submit" name="action">Log In
        <i class="material-icons right">send</i>
      </button>
    </div>
    <div class="row center-align">
      <div class="divider"></div>
      <h5>Don't have an account?</h5>
      <a class="waves-effect waves-light btn white teal-text modal-trigger modal-close" href="#registerModal">Join</a></li>
    </div>
  </form> 
</div>
<!-- REGISTER -->

<div id="registerModal" class="modal">
  <form class="modal-content col s12" action="{{ route('register') }}" method="post">
    @csrf
    <div class="row center">
      <h4>Join INT</h4>
      <div class="divider"></div>
    </div>
    <div class="row">
      <div class="input-field col s12 m6">        
        {{Form::text('first_name','')}}
        {{Form::label('first_name','Ime',['for'=>'first_name', 'required'=>'required'])}}
      </div>          
      <div class="input-field col s12 m6">     
        {{Form::text('last_name','')}}
        {{Form::label('last_name','Prezime',['for'=>'last_name', 'required'=>'required'])}}
      </div>
      <div class="input-field col s12 m6">        
        {{Form::email('email','')}}
        {{Form::label('email','Email',['for'=>'email', 'required'=>'required'])}}
      </div>      
      <div class="input-field col s12 m6">
        {{Form::text('city','')}}
        {{Form::label('city','Grad',['for'=>'city', 'required'=>'required'])}}
      </div>
      <div class="input-field col s12">        
        {{Form::password('password')}}
        {{Form::label('password','Lozinka',['for'=>'password', 'required'=>'required'])}}
      </div>
      <div class="input-field col s12">
        {{Form::password('password_confirmation')}}
        {{Form::label('password_confirmation','Potvrdite lozinku',['for'=>'password_confirmation', 'required'=>'required'])}}
      </div>    
    </div>
    <div class="row center-align">
        <button class="btn s12 teal waves-effect waves-light" type="submit" name="action">Register
          <i class="material-icons right">send</i>
        </button>
    </div>
    <div class="divider"></div>
    <div class="row center-align">
      <h5>Already have an account?</h5>
      <a class="waves-effect waves-light btn white teal-text modal-trigger modal-close" href="#loginModal">Log In</a></li>
    </div>
  </form>
</div>