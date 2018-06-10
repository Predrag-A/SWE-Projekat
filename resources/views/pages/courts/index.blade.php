@extends('layouts.app')
@section('content')

<div class="container">
  
  {!! Form::open(['action' => ['CourtController@search'], 'method' => 'GET']) !!}         
    <div class="row">
      <div class="col s3 m2 l1" style="padding-top:10px;">
        <button class="btn-floating btn-large waves-effect waves-light" type="submit"><i class="material-icons">search</i></button>
      </div>
      <div class="input-field col s9 m10 l11">          
        <input id="search" type="search" name="query" required>
        <i class="material-icons">close</i>
      </div>
    </div>  
  {!! Form::close() !!}

  @if(count($courts) > 0)
  <div class = "row">
    @foreach($courts as $court)
    <div class="col s6 l4">
        <div class="card medium col-content z-depth-3">
          
          <!-- SLIKA -->
          <div class="card-image waves-effect waves-block waves-light">
            <img class="activator" src="{{route('index')}}/storage/tereni/{{$court->mainImage()}}">
            <span class="card-title activator"></span>
          </div>

          <!-- LINK -->
          <div class="card-action center">
            <a href="{{route('tereni')}}/{{$court->id}}" class="card-title">Detalji</a>
          </div>

          <!-- TEKST U KARTICI -->
          <div class="card-content">
            <span class="card-title">{{$court->name()}}</span>
            <span>{{$court->address()}}, {{$court->city->name}}</span>    
          </div>
          
          <!-- TEXT STO ISKACE -->
          <div class="card-reveal">
            <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
            <div class="row"> 
              <h6>Aktivni događaji: <span>{{count($court->activeEvents())}}</span></h6>
              <h6>Ocena terena:</h6>
              <star-rating :inline="true" :read-only="true" :rating="{{$court->averageGrade()}}" :round-start-rating="false" :star-size="20"></star-rating>
              <h6>Vaša ocena:</h6>
              <star-rating :inline="true" :read-only="true" :rating="{{Auth::user()->courtRating($court->id)}}" :round-start-rating="false" :star-size="20"></star-rating>
              <h6>Sportovi:</h6>
              @foreach($court->sports() as $sport) 
              <span><i class="{{$sport->returnIcon()}}"></i>{{$sport->name}}</span><br>
              @endforeach
            </div>
          </div>
        </div>      
      </div>
      @endforeach     
      <div class="row center col s12">
        {!! $courts->render() !!}
      </div> 
    </div>
  @else
  <div class="row center blue-grey-text text-lighten-2">
    <h4>Nije pronađen nijedan teren</h4>
  </div>
  @endif
</div>

@endsection