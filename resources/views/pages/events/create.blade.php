@extends('layouts.app')
@section('content')

<div class="container">
  
  <h1>Napravi dogadjaj</h1>
    {!! Form::open(['action' => 'EventController@store', 'method' => 'POST']) !!}
    
  <div class="row col s12 m16">
    <div class="input-field col s12 m6">
      {{Form::text('date','', ['required'=>'required', 'placeholder' => ' ', 'class' => 'datepicker'])}}
      {{Form::label('date','Datum',['for'=>'datum'])}}
    </div>

    <div class="input-field col s12 m6">
      {{Form::text('time','', ['required'=>'required', 'placeholder' => ' ','class' => 'timepicker'])}}
      {{Form::label('time','Vreme',['for'=>'vreme'])}}
    </div>

    <div class="input-field col s12 m6">
      <select name="city" id="city">
        <option value="" disabled selected>Izaberite grad</option>
        @foreach($cities as $city)
        <option value="{{$city->id}}">{{$city->name}}</option>
        @endforeach
      </select>
      <label>Grad</label>
    </div>   

    <div class="input-field col s12 m6">
      <select name="court" id="court">
        <option value="" disabled selected>Izaberite teren</option>       
      </select>
      <label>Teren</label>
    </div>  

    <div class="input-field col s12 m6">
      <select name="sport" id="sport">
        <option value="" disabled selected>Izaberite sport</option>       
      </select>
      <label>Sport</label>
    </div> 
  </div>
  <div class="row center align">
    {{Form::button('Potvrda <i class="material-icons right">send</i>',['type'=>'submit', 'class'=>'btn s12 blue darken-4 waves-effect waves-light'])}}
  </div>
  {!! Form::close() !!}

</div>

<script>

  $(document).ready(function(){

    // Biranje select-a sa idjem city
    $('#city').change(function(){
      // Prijem vrednosti api-ja na ruti /api/tereni slanjem get requesta
      // sa idjem grada
      $.get("{{ url('/api/tereni')}}", {option: $(this).val()}, function(data){
        console.log(data);

        // Prazni se select
        $('#court').empty();
        
        if(typeof data !== 'undefined ' && data.length > 0){

          $('#court').append("<option value='' disabled selected>Izaberite teren</option>");

          // Dodaju se optioni iz api-ja
          $.each(data, function(key, element) {
            $('#court').append("<option value='" + element.id +"'>" + element.location + "</option>");
          });
        }
        else{
          $('#court').append("<option value='' disabled selected>Grad trenutno nema dodate terene</option>");
          $('#sport').empty();
        }
        $("#court").trigger('contentChangedCourt');
      });      
    })

    $('#court').change(function(){

      // Prijem vrednosti api-ja na ruti /api/sportovi slanjem get requesta
      // sa idjem terena
      $.get("{{ url('/api/sportovi')}}", {option: $(this).val()}, function(data){
        

        // Prazni se select
        $('#sport').empty();       
                
        $('#sport').append("<option value='' disabled selected>Izaberite sport</option>");

        // Dodaju se optioni iz api-ja
        $.each(data, function(key, element) {
          $('#sport').append("<option value='" + element.id +"'>" + element.name + "</option>");
        });

        $("#sport").trigger('contentChangedSport');
      });      
    })

    // Mora da se resetuju selectovi, glupi materialize
    $('#court').on('contentChangedCourt', function() {
      $(this).material_select();      
      $("#sport").trigger('contentChangedSport');
    });
    $('#sport').on('contentChangedSport', function() {
      $(this).material_select();
    });
  });
  
</script>

@endsection