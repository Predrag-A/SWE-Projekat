@extends('layouts.app')
@section('content')


<div class="container">
  <div class="card">
    <div class="card-content">
      <div class="row">
        <h3>{{$event->sport->name}}</h3>
        <div>Vreme odrzavanja: {{$event->time}}</div>
        <div>Lokacija: {{$event->court->location}}</div>
        <div>Kreirao: {{$event->user->first_name}} {{$event->user->last_name}}</div>    
            
        @if(Auth::user()->id == $event->user_id)
        <div class="valign-wrapper">
          <a href= "{{route('dogadjaji')}}/{{Auth::user()->id}}/edit" class = "waves-effect waves-light btn left">Izmeni</a>

          {!!Form::open(['action' => ['EventController@destroy', $event->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
              {{Form::hidden('_method', 'DELETE')}}
              {{Form::submit('Obriši', ['class' => 'waves-effect waves-light btn right red'])}}
          {!!Form::close()!!}
        </div>
        @endif
      </div>
      
    </div>
  </div>
</div>

@endsection
