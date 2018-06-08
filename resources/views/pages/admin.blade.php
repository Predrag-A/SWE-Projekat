@extends('layouts.app')
@section('content')

<div class="row">
  <div class="col s12">  
    <ul class="tabs tabs-fixed-width">
      <li class="tab col s6"><a href="#tab-1">Zahtevi</a></li>
      <li class="tab col s6"><a href="#tab-2">Dodavanje</a></li>
    </ul>
  </div>

  <!-- ZAHTEVI -->
  <div id="tab-1" class="col s12">  
    <div class="container">
      @if(count($requests) > 0)     
      <ul class="collapsible popout">
        @foreach($requests as $request)
        <request :request="{{$request}}" :user="{{$request->user}}"></request>
        @endforeach    
      </ul>
      <div class="row center">    
        {!! $requests->render() !!}
      </div>
      @else    
      <div class="row center blue-grey-text text-lighten-2">
        <h4>Trenutno nema aktivnih zahteva</h4>
      </div>
      @endif
    </div>
  </div>

  <!-- DODAVANJE -->
  <div id="tab-2" class="col s12">
    <div class="container">        
      <admin-map name="{{Auth::user()->id}}" :cities="{{$cities}}"></admin-map>          
    </div>
  </div>
  
</div>

@endsection