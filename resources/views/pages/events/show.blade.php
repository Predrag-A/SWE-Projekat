@extends('layouts.app')
@section('content')


<div class="container">

  <div class="card z-depth-3" style="border: 1px solid {{$event->sport->color}}">    
    <event-map 
      name="{{$event->id}}" 
      lat={{$event->court->lat}} 
      long={{$event->court->long}}
      courtname="{{$event->court->name()}}"
      courtaddress="{{$event->court->address()}}"
      cityname="{{$event->court->city->name}}"></event-map>
    <div class="card-content">
      <div class="row">                
        <blockquote>
          Sport: <span class="{{$event->sport->color}}-text">{{$event->sport->name}}</span>
          <br>
          Datum održavanja: <span class="blue-grey-text text-lighten-2">{{$event->localizedDate()}}, {{$event->getTimeNoSeconds()}}</span>
        </blockquote>
        <countdown-timer date="{{$event->time}}" tag="h4" inputstyle=" "></countdown-timer> 
        
      </div>            
    </div>
    @if(Auth::user()->id == $event->user_id && !$event->isOver()) 
    <div class="card-action">
      
      <!-- DUGME ZA EDITOVANJE -->
      <a href= "#editModal" class = "waves-effect waves-light btn-flat modal-trigger">Izmeni</a>

      <!-- DUGME ZA BRISANJE -->
      {!!Form::open(['action' => ['EventController@destroy', $event->id], 'method' => 'POST', 'style' => 'display:inline'])!!}
          {{Form::hidden('_method', 'DELETE')}}
          {{Form::button('Obriši', ['type' => 'submit', 'class' => 'waves-effect waves-light btn-flat red-text right'])}}
      {!!Form::close()!!}
    </div>        
    @endif
  </div>
    <div class="row">    

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
            <div class="col s12 m6 l12">
              <div class="horizontal card">
      
                <div class="card-image">
                  <img style="height:50px" src="{{route('index')}}/storage/avatars/{{$user->user_img}}">
                </div>
      
                <div class="container">       
                  <div class="left-align">   
                    <a href="{{route('korisnici')}}/{{$user->id}}" class="blue-text text-darken-2"><b>{{$user->first_name}} {{$user->last_name}}</b></a>
                  </div>  
                  @if($user->id == $event->user_id)      
                  <span class="green-text left">
                    Kreator
                  </span>
                  @endif
                </div>
      
              </div>
            </div>
            @endforeach
          </div>        
        </div>
      <!-- KOMENTARI -->
      <div class="col s12 l8">
        <comments :user="{{auth()->user()}}" :eventid="{{$event->id}}"></comments>        
      </div>

    </div>

  </div>
</div>


<!-- FORMA ZA IZMENE / MODAL -->
<div class="modal" id="editModal">
  <div class="modal-content">
  
    <div class="row center blue-grey-text text-lighten-2">
      <h4>Izmeni događaj</h4>
    </div>
      {!! Form::open(['action' => ['EventController@update', $event->id], 'method' => 'POST']) !!}
      
    <div class="row col s12 m16">
      <div class="input-field col s12 m6">
        {{Form::text('date', $event->getDate(), ['required'=>'required', 'class' => 'datepicker'])}}
        {{Form::label('date','Datum',['for'=>'datum'])}}
      </div>

      <div class="input-field col s12 m6">
        {{Form::text('time', $event->getTime(), ['required'=>'required','class' => 'timepicker'])}}
        {{Form::label('time','Vreme',['for'=>'vreme'])}}
      </div>
      
      <event-select :cities="{{$cities}}"></event-select>
    
    <div class="row center align">
      
      {{Form::hidden('_method','PUT')}}
      {{Form::button('Potvrda <i class="material-icons right">send</i>',['type'=>'submit', 'class'=>'btn s12 blue darken-4 waves-effect waves-light'])}}
    </div>
    {!! Form::close() !!}
</div>

</div>


@endsection
