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
  @if(count($events) > 0)
    <div class = "row">
      @foreach($events as $event)
      <div class="col s6 l4">
        <div class="card medium col-content z-depth-3" style="border: 1px solid {{$event->sport->color}}">
          
          <!-- SLIKA -->
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="/img/{{$event->sport->image}}">
            <span class="card-title activator">{{$event->localizedDate()}}, {{$event->getTimeNoSeconds()}}</span>
          </div>

          <!-- LINK -->
          <div class="card-action center">
            <a href="{{route('dogadjaji')}}/{{$event->id}}" class="card-title {{$event->sport->color}}-text">Detalji</a>
          </div>
          
          <!-- TEKT U KARTICU -->
          <div class="card-content">
            <span class="card-title {{$event->sport->color}}-text">Kreirao:</span>
            <a href="{{route('korisnici')}}/{{$event->user->id}}" class="black-text">{{$event->user->first_name}} {{$event->user->last_name}}</a>       
          </div>
          
          <!-- TEXT STO ISKACE -->
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">{{$event->sport->name}}<i class="material-icons right">close</i></span>
            <div class="row">              
              <h6>Pridruženi korisnici:</h6>
              <span>{{$event->attendsCount()}}</span>
              <h6>Adresa:</h6>
              <span>{{$event->court->address()}}, {{$event->court->city->name}}</span>
              <h6>Ocena terena:</h6>
              <star-rating :inline="true" :read-only="true" :rating="{{$event->court->averageGrade()}}" :round-start-rating="false" :star-size="25"></star-rating>
              <h6>Vaša ocena:</h6>
              <star-rating :inline="true" :read-only="true" :rating="{{Auth::user()->courtRating($event->court->id)}}" :round-start-rating="false" :star-size="25"></star-rating>
            </div>
          </div>

        </div>      
      </div>
      @endforeach      
      {!! $events->render() !!}
    </div>
  @else
  <p>Trenutno nema kreiranih dogadjaja.</p>
  @endif
</div>

@endsection
