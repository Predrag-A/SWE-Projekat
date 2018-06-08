@extends('layouts.app')
@section('content')

<div class="container">
  <nav>
    <div class="nav-wrapper">
      <form>
        <div class="input-field">
          <input id="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
        </div>
      </form>
    </div>
  </nav>

  @if(count($courts) > 0)
  <div class = "row">
    @foreach($courts as $court)
    <div class="col s6 l4">
        <div class="card medium col-content z-depth-3">
          
          <!-- SLIKA -->
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="{{$court->getMainPicture()}}">
            <span class="card-title activator"></span>
          </div>

          <!-- LINK -->
          <div class="card-action center">
            <a href="{{route('tereni')}}/{{$court->id}}" class="card-title">Detalji</a>
          </div>
          
          <!-- TEKST U KARTICI -->
          <div class="card-content">
            <span class="card-title">Lokacija:</span>
            <span>{{$court->location}}</span>    
          </div>
          
          <!-- TEXT STO ISKACE -->
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
            <div class="row">              
              <h6>Lokacija:</h6>
              <span>{{$court->location}}, {{$court->city->name}}</span>
              <h6>Ocena terena:</h6>
              <star-rating :inline="true" :read-only="true" :rating="{{$court->averageGrade()}}" :round-start-rating="false" :star-size="25"></star-rating>
              <h6>Vaša ocena:</h6>
              <star-rating :inline="true" :read-only="true" :rating="{{Auth::user()->courtRating($court->id)}}" :round-start-rating="false" :star-size="25"></star-rating>
            </div>
          </div>
        </div>      
      </div>
      @endforeach      
      {!! $courts->render() !!}
    </div>
  @else
  <p>Trenutno nema dodatih terena.</p>
  @endif
</div>

@endsection