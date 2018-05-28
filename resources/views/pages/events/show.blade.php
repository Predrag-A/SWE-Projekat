@extends('layouts.app')
@section('content')


<div class="container">

  <div class="card">    
    <event-map name="{{$event->id}}" lat={{$event->court->lat}} long={{$event->court->long}}></event-map>
    <div class="card-content">
      <div class="row">
        <h3>{{$event->sport->name}}</h3>
        <div>Vreme odrzavanja: {{$event->time}}</div>
        <div>Lokacija: {{$event->court->location}}</div>
        <div>Kreirao: {{$event->user->first_name}} {{$event->user->last_name}}</div>    
            
        @if(Auth::user()->id == $event->user_id)
        <div class="valign-wrapper">
          
          <!-- DUGME ZA EDITOVANJE -->
          <a href= "{{route('dogadjaji')}}/{{$event->id}}/edit" class = "waves-effect waves-light btn left">Izmeni</a>

          <!-- DUGME ZA BRISANJE -->
          {!!Form::open(['action' => ['EventController@destroy', $event->id], 'method' => 'POST'])!!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Obriši', ['class' => 'waves-effect waves-light btn right red'])}}
          {!!Form::close()!!}
        </div>
        @else
        <div>
          <!-- DUGME ZA ODJAVLJIVANJE -->
          @if(Auth::user()->isAttending($event->id))
            {!!Form::open(['action' => ['AttendsController@destroy', $event->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Odjavi se', ['class' => 'waves-effect waves-light btn red'])}}
            {!!Form::close()!!}
          @else
          <!-- DUGME ZA PRIJAVLJIVANJE -->
            {!!Form::open(['action' => ['AttendsController@store', $event->id], 'method' => 'POST'])!!}
                {{Form::hidden('event', $event->id)}}
                {{Form::submit('Pridruži se', ['class' => 'waves-effect waves-light btn'])}}
            {!!Form::close()!!}
          @endif      

        </div>
        @endif
      </div>
      
    </div>
  </div>
  
  <div class="row">

    <!-- KOMENTARI -->
    <div class="col s12 l8">
      <comments :user="{{auth()->user()}}" :eventid="{{$event->id}}"></comments>        
    </div>

    <!-- LISTA PRIJAVLJENIH KORISNIKA -->
    <div class="col s12 l4">
      <div class="center">
        <h5>Prijavljeni korisnici</h5>
        <div class="row"></div>
          @foreach($event->attends() as $user)
          <div class="col s6 l12">
            <div class="horizontal card">
    
              <div class="card-image">
                <img style="height:50px" src="{{route('index')}}/storage/avatars/{{$user->user_img}}">
              </div>
    
              <div class="container">       
                <div class="left-align">   
                  <a href="{{route('korisnici')}}/{{$user->id}}" class="blue-text text-darken-2"><b>{{$user->first_name}} {{$user->last_name}}</b></a>
                </div>        
              </div>
    
            </div>
          </div>
          @endforeach
        </div>        
      </div>
    </div>

  </div>

</div>

@endsection
