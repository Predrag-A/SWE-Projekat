@extends('layouts.app')
@section('content')

<!-- PRVI PARALLAX -->
<div id="index-banner" class="parallax-container">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="header center"><img src="{{asset('img/logo_shadow.png')}}" style="width:340px;"></div>
      <div class="row center">
        <h5 class="header col s12 white-text text-light-4" style="text-shadow: black 0px 0px 10px;">Najbolja besplatna aplikacija za sportske fanatike!</h5>
      </div>
      <br><br>
    </div>
  </div>
  <div class="parallax"><img src="{{asset('img/background1.jpg')}}" alt="Unsplashed background img 1"></div>
</div>

<!-- PRVA SEKCIJA -->
<div class="container">
  <div class="section">

    <!--   IKONE   -->
    <div class="row">
      <div class="col s12 m4">
        <div class="icon-block">
          <h2 class="center green-text text-lighten-2"><i class="large material-icons">event_available</i></h2>
          <h5 class="center">Kreiraj događaj ...</h5>
        </div>
      </div>

      <div class="col s12 m4">
        <div class="icon-block">
          <h2 class="center green-text text-lighten-2"><i class="large material-icons">group</i></h2>
          <h5 class="center">... okupi ekipu ...</h5>
        </div>
      </div>

      <div class="col s12 m4">
        <div class="icon-block">
          <h2 class="center green-text text-lighten-2"><i class="large material-icons">sentiment_very_satisfied</i></h2>
          <h5 class="center">... i zabavi se!</h5>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- DRUGI PARALLAX -->
<div class="parallax-container one valign-wrapper">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="row center">
        <h5 class="header col s12 white-text" style="text-shadow: black 0px 0px 10px;">Nemoj samo da sedis već okupi ekipu i zabavi se!</h5>
      </div>
    </div>
  </div>
  <div class="parallax"><img src="{{asset('img/background2.jpg')}}" alt="Unsplashed background img 2"></div>
</div>

<!-- DRUGA SEKCIJA -->
<div class="container">
  <div class="section">

    <div class="row">
      <div class="col s12 center">
        <h3><i class="mdi-content-send brown-text"></i></h3>
        <h4>Registruj se!</h4>
        <p class="center-align light">Registracija je potpuno besplatna i zato nemoj da čekas vec kreni u akciju, okupi ekipu, pokaži ko je bolji i zabavi se!</p>
      </div>
    </div>

  </div>
</div>

<!-- TRECI PARALLAX -->
<div class="parallax-container two valign-wrapper">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="row center">
        <h5 class="header col s12 white-text" style="text-shadow: black 0px 0px 10px;">Fair play pre svega!</h5>
      </div>
    </div>
  </div>
  <div class="parallax"><img src="{{asset('img/background3.jpg')}}" alt="Unsplashed background img 3"></div>
</div>    
@endsection
