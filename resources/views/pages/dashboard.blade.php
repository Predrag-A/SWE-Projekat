@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="hide-on-med-and-down col l3">
      <div class="card-panel center hoverable">
        <div class="name">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</div>
        <div>{{Auth::user()->city}}</div>
        <div class="divider"></div>
        <div>{{Auth::user()->status}}</div>
      </div>
    </div>
    <div class="col s12 l9">
      <div class="card-panel">        
        <h5>Content PH</h5>
      </div>
    </div>
  </div>
</div>

@endsection