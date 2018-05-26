@extends('layouts.app')
@section('content')

<div class="container">
  <h2>Dogadjaji</h2>
  
  @if(count($events) > 0)
    <div class = "row">
      @foreach($events as $event)
      <div class="col s6 l4">
        <div class="card medium col-content z-depth-3" style="border: 1px solid {{$event->sport->color}}">
          
          <!-- SLIKA -->
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="/img/{{$event->sport->image}}">
          </div>

          <!-- LINK -->
          <div class="card-content white-text">
            <a href="{{route('dogadjaji')}}/{{$event->id}}"class="card-title">{{$event->time}}</a>
          </div>
          
          <!-- TEXT STO ISKACE -->
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
            <p>Here is some more information about this product that is only revealed once clicked on.</p>
          </div>

        </div>      
      </div>
      @endforeach      
      {{$events->render()}}
    </div>
  @else
  <p>Trenutno nema kreiranih dogadjaja.</p>
  @endif
</div>

@endsection
