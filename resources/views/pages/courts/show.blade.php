@extends('layouts.app')
@section('content')

<div class="container">  

  <div class="card">
    <!-- SLIDESHOW ZA SLIKE -->
    @if(count($court->getPictures()) > 0)
      <div class="slider">
        <ul class="slides">
          @foreach($court->getPictures() as $slika)
          <li>
            <img src="{{$slika}}">
            <div class="caption center-align">
              <!--<h3>This is our big Tagline!</h3>
              <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>-->
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    @else
      <h3>Teren trenutno nema dodatih slika!</h3>
    @endif
    <div class="card-content">
      <div class="row">
        <h3>{{$court->location}}</h3>
        <h5>Lokacija:</h5>
        <div>{{$court->location}}</div>
        <h5>Opis:</h5> 
        <div>Dobar Dobar nije los mali</div>
        <h5>Sportovi:</h5>
        @foreach($court->sports() as $sport) 
        <span><i class="{{$sport->returnIcon($sport->name)}}"></i> {{$sport->name}}</span>
        @endforeach
        <!-- NE REFRESHUJE SE KAD SE OCENI TEREN ZATO STO NIJE U ISTOJ KOMPONENTI
        <h6>Ocena terena:</h6>
        <star-rating :inline="true" :read-only="true" :rating="{{$court->averageGrade()}}" :round-start-rating="false" :star-size="25"></star-rating>
        -->
        <h6>Ocenite teren:</h6>
         <!-- OCENE -->
        <star-rating star-size="25" :show-rating="false" :rating="{{Auth::user()->courtRating($court->id)}}" :court_id="{{$court->id}}"></star-rating>
        
      </div>
    </div>
  </div>
</div>

@endsection