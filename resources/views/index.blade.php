@extends('layouts.app')
@section('content')

<!-- PRVI PARALLAX -->
<div id="index-banner" class="parallax-container">
  <div class="section no-pad-bot">
    <div class="container">
      <br><br>
      <br><br>
      <h1 class="header center white-text text-darken-4">IZAĐI NA TEREN</h1>
      <br><br>
      <br><br>
      <div class="row center">
        <h5 class="header col s12 white-text light">Najbolja besplatna aplikacija za sportske fanatike!</h5>
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
          <h5 class="center">Kreiraj dogadjaj ...</h5>
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
        <h5 class="header col s12 white-text">Nemoj samo da sedis vec okupi ekipu i zabavi se!</h5>
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
        <p class="center-align light">Registracija je potpuno besplatna i zato nemoj da cekas vec kreni u akciju, okupi ekipu, pokazi ko je bolji i zabavi se!</p>
      </div>
    </div>

  </div>
</div>

<!-- TRECI PARALLAX -->
<div class="parallax-container two valign-wrapper">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="row center">
        <h5 class="header col s12 white-text">Fair play pre svega!</h5>
      </div>
    </div>
  </div>
  <div class="parallax"><img src="{{asset('img/background3.jpg')}}" alt="Unsplashed background img 3"></div>
</div>    
@endsection
