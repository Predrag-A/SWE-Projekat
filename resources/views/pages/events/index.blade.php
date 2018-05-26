@extends('layouts.app')
@section('content')

<div class="container">
  <h1>Dogadjaji</h1>
  
  @if(count($events) > 0)
    <div class="col s12 m6 center">
      @foreach($events as $event)
      <div class="card" style="border: 1px solid {{$event->sport->color}}">
        <div class="card-content white-text">
          <a href="{{route('dogadjaji')}}/{{$event->id}}"class="card-title">{{$event->time}}</a>
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
