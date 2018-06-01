@extends('layouts.app')
@section('content')

<div class="row">
  <div class="col s12">  
    <ul class="tabs">
      <li class="tab col s6"><a href="#swipe-1">Zahtevi</a></li>
      <li class="tab col s6"><a href="#swipe-2">Dodavanje</a></li>
    </ul>
  </div>

  <!-- ZAHTEVI -->
  <div id="swipe-1" class="col s12">
    @if(count($requests) > 0) 
    <div class="row center">    
      {!! $requests->render() !!}
    </div>
    <ul class="collapsible">
      @foreach($requests as $request)
      <request :request="{{$request}}" :user="{{$request->user}}"></request>
      @endforeach    
    </ul>
    
    @else
    
    <div class="row center">
      <h4>Trenutno nema aktivnih zahteva</h4>
    </div>

    @endif
</div>

<!-- DODAVANJE -->
<div id="swipe-2" class="col s12">
 
</div>

@endsection