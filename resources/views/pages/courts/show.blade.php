@extends('layouts.app')
@section('content')

<div class="container row">  

  
  
  @if(Auth::user()->isAdmin())
  <!-- IZMENE -->
  <div class="col s12">
    <div class="card">        
      <blockquote class="blue-grey-text text-lighten-2">
          <b>Napomena:</b><br>
          U slučaju dodavanja više slika odjednom, sve dodate slike nakon dostizanja maksimalnog broja slika (6) će biti odbačene. U slučaju dostizanja maksimalnog broja slika potrebno je obrisati postojeće da bi se dodale nove.
      </blockquote>
      <div class="card-content">
          {!! Form::open(['action' => ['CourtController@update', $court->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      
          <div class="file-field input-field col s12">
            <div @if(count($court->images) > 5) class="btn disabled" @else class="btn" @endif>
              <span>SLIKE</span>
              <input type="file" name="images[]" accept="image/*" multiple>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" @if(count($court->images) > 5) disabled placeholder="Maksimalni broj slika je 6" @endif placeholder="Dodajte jednu ili više slika">
            </div>
          </div>

          <div class="input-field col s12">
            <input id="location" type="text" name="location" value="{{$court->location}}">
            <label for="location">Lokacija</label>
          </div> 

          <label class="col s4">
            <input type="checkbox" name="football" value="1" @if($court->hasSport("Fudbal")) checked @endif/>
            <span>Fudbal</span>
          </label>
          <label class="col s4">
            <input type="checkbox" name="basketball" value="1" @if($court->hasSport("Košarka")) checked @endif/>
            <span>Košarka</span>
          </label>
          <label class="col s4">
            <input type="checkbox" name="handball" value="1" @if($court->hasSport("Rukomet")) checked @endif/>
            <span>Rukomet</span>
          </label>
          <label class="col s4">
            <input type="checkbox" name="tennis" value="1" @if($court->hasSport("Tenis")) checked @endif/>
            <span>Tenis</span>
          </label>
          <label class="col s4">
            <input type="checkbox" name="futsal" value="1" @if($court->hasSport("Futsal")) checked @endif/>
            <span>Futsal</span>
          </label>
          <label class="col s4">
            <input type="checkbox" name="volleyball" value="1" @if($court->hasSport("Odbojka")) checked @endif/>
            <span>Odbojka</span>
          </label>           

          <div class="input-field col s12">
            <textarea id="opis" class="materialize-textarea" name="opis">{{$court->description}}</textarea>
            <label for="opis">Opis</label>
          </div>        
          
            
          <div class="row center align">            
            {{Form::hidden('_method','PUT')}}
            {{Form::button('Izmeni <i class="material-icons right">send</i>',['type'=>'submit', 'class'=>'btn s12 blue darken-4 waves-effect waves-light'])}}
          </div>
          {!! Form::close() !!}
      </div>
    </div>
  </div>  
  @endif

  <!-- GLAVNI -->
  <div class="col s12">
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
        </div>                
        <div class="divider"></div>   
      @endif        
    
      <div class="card-content">      
        <div class="row">
          <h3>{{$court->location}}</h3>
          <h5>Lokacija:</h5>
          <div>{{$court->location}}</div>
          <h5>Opis:</h5> 
          <div>{{$court->description}}</div>
          <h5>Sportovi:</h5>
          @foreach($court->sports() as $sport) 
          <span><i class="{{$sport->returnIcon()}}"></i> {{$sport->name}}</span>
          @endforeach
          <!-- NE REFRESHUJE SE KAD SE OCENI TEREN ZATO STO NIJE U ISTOJ KOMPONENTI
          <h6>Ocena terena:</h6>
          <star-rating :inline="true" :read-only="true" :rating="{{$court->averageGrade()}}" :round-start-rating="false" :star-size="25"></star-rating>
          -->
          <h6>Ocenite teren:</h6>
          <!-- OCENE -->
          <star-rating star-size='25' :show-rating="false" :rating="{{Auth::user()->courtRating($court->id)}}" :court_id="{{$court->id}}"></star-rating>
          
        </div>
      </div>
    </div>
  </div>
 
</div>

@endsection