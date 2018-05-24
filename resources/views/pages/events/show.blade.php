@extends('layouts.app')
@section('content')


<div class="container">
  <div class="col s12 m6">
    <div class="card blue-grey">
      <div class="card-content white-text">
        <div class="row">
          <h3>{{$event->id}}</h3>
          <p>{{$event->time}}</p>          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
