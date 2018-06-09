@extends('layouts.app')
@section('content')

<div class="container">  

  <div class="card">
    <!-- SLIDESHOW ZA SLIKE -->
    @if(count($court->images) > 0)
      <div class="slider">
        <ul class="slides">
          @foreach($court->images as $image)
          <li>
            <!-- BRISANJE MOGUCE SAMO ZA ADMINE -->
            @if(Auth::user()->isAdmin())
            <div class="caption right-align">              
              {!!Form::open(['action' => ['CourtController@deleteImage'], 'method' => 'POST'])!!}
                {{Form::hidden('image_id', $image->id)}}
                {{Form::button('Obriši Sliku <i class="material-icons right">clear</i>', ['type' => 'submit', 'class' => 'waves-effect waves-light btn red'])}}
              {!!Form::close()!!}
            </div>
            @endif
            <img src="{{route('index')}}/storage/tereni/{{$image->court_img}}">
            
          </li>
          @endforeach
        </ul>
      </div>
    @else
      <div class="row center blue-grey-text text-lighten-2">
        <h4>Teren trenutno nema dodatih slika</h4>             
        <div class="divider"></div>   
      </div>
    @endif        
   
    <div class="card-content">

      <!-- IZMENE, TEMP -->
      @if(Auth::user()->isAdmin())
      
      <blockquote class="blue-grey-text text-lighten-2">
          <b>Napomena:</b><br>
          U slučaju dodavanja više slika od jednom, sve dodate slike nakon dostizanja maksimalnog broja slika (6) će biti odbačene. U slučaju dostizanja maksimalnog broja slika potrebno je obrisati postojeće da bi se dodale nove.
      </blockquote>
      <div class="row center">
          {!! Form::open(['action' => ['CourtController@update', $court->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      
          <div class="file-field input-field col s12">
            <div @if(count($court->images) > 5) class="btn disabled" @else class="btn" @endif>
              <span>SLIKE</span>
              <input type="file" name="images[]" multiple>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" @if(count($court->images) > 5) disabled placeholder="Maksimalni broj slika je 6" @endif placeholder="Dodajte jednu ili više slika">
            </div>
          </div>          
         
        <div class="row center align">
          
          {{Form::hidden('_method','PUT')}}
          {{Form::button('Potvrda <i class="material-icons right">send</i>',['type'=>'submit', 'class'=>'btn s12 blue darken-4 waves-effect waves-light'])}}
        </div>
        {!! Form::close() !!}
      </div>
      @endif

      <div class="row">
        <h3>{{$court->location}}</h3>
        <h5>Lokacija:</h5>
        <div>{{$court->location}}</div>
        <h5>Opis:</h5> 
        <div>Dobar Dobar nije los mali</div>
        <h5>Sportovi:</h5>
        @foreach($court->sports() as $sport) 
        <span><i class="{{$sport->returnIcon($sport->name)}}"></i> {{$sport->name}}</span>
        @endforeach
        <!-- NE REFRESHUJE SE KAD SE OCENI TEREN ZATO STO NIJE U ISTOJ KOMPONENTI
        <h6>Ocena terena:</h6>
        <star-rating :inline="true" :read-only="true" :rating="{{$court->averageGrade()}}" :round-start-rating="false" :star-size="25"></star-rating>
        -->
        <h6>Ocenite teren:</h6>
         <!-- OCENE -->
        <star-rating star-size="25" :show-rating="false" :rating="{{Auth::user()->courtRating($court->id)}}" :court_id="{{$court->id}}"></star-rating>
        
      </div>
    </div>
  </div>
</div>

@endsection