@extends('layouts.app')
@section('content')


<div class="container">

  <div class="card">    
    <event-map name="{{$event->id}}" lat={{$event->court->lat}} long={{$event->court->long}}></event-map>
    <div class="card-content">
      <div class="row">        
        <countdown-timer date="{{$event->time}}" tag="h4" inputstyle=" "></countdown-timer> 
        
        <div>Vreme odrzavanja: {{$event->time}}</div>
        <div>Teren: <a href="{{route('tereni')}}/{{$event->court->id}}">{{$event->court->location}}</a></div>
        <div>Kreirao: {{$event->user->first_name}} {{$event->user->last_name}}</div>   
      </div>            
    </div>
    @if(Auth::user()->id == $event->user_id && !$event->isOver()) 
    <div class="card-action">
      
      <!-- DUGME ZA EDITOVANJE -->
      <a href= "{{route('dogadjaji')}}/{{$event->id}}/edit" class = "waves-effect waves-light btn-flat">Izmeni</a>

      <!-- DUGME ZA BRISANJE -->
      {!!Form::open(['action' => ['EventController@destroy', $event->id], 'method' => 'POST', 'style' => 'display:inline'])!!}
          {{Form::hidden('_method', 'DELETE')}}
          {{Form::button('Obriši', ['type' => 'submit', 'class' => 'waves-effect waves-light btn-flat red-text right'])}}
      {!!Form::close()!!}
    </div>        
    @endif
  </div>
  <div class="row">

    <!-- KOMENTARI -->
    <div class="col s12 l8">
      <comments :user="{{auth()->user()}}" :eventid="{{$event->id}}"></comments>        
    </div>

    <!-- LISTA PRIJAVLJENIH KORISNIKA -->
    <div class="col s12 l4">
      <div class="center">
        @if(Auth::user()->id !== $event->user_id)
          <!-- DUGME ZA ODJAVLJIVANJE -->
          @if(!$event->isOver())
            @if(Auth::user()->isAttending($event->id))
            {!!Form::open(['action' => ['AttendsController@destroy', $event->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Odjavi se', ['class' => 'btn red white-text'])}}
            {!!Form::close()!!}
            @else
            <!-- DUGME ZA PRIJAVLJIVANJE -->
            {!!Form::open(['action' => ['AttendsController@store', $event->id], 'method' => 'POST'])!!}
                {{Form::hidden('event', $event->id)}}
                {{Form::submit('Pridruži se', ['class' => 'btn white-text'])}}
            {!!Form::close()!!}
            @endif 
          @endif
        @endif
        <div class="row"></div>
          @foreach($event->attends as $user)
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
