@extends('layouts.app')
@section('content')

<!-- ovo je vue.js komponenta gde pomocu propa saljemo neku vrednost-->
<google-map name="serbia" createbtnurl="{{route('dogadjaji')}}" userstatus="{{Auth::user()->status}}"></google-map>

<div id="eventCreateModal" class="modal" style="height:410px; width:70%">
  <div class="modal-content">
      {!! Form::open(['action' => 'EventController@store', 'method' => 'POST']) !!}
    <div class="row center">
      <h4 class="blue-grey-text text-lighten-2">Novi događaj</h4>
      <div class="divider"></div>
    </div>
    <div class="row">
      <div class="input-field col s12 l6">
      <i class="material-icons prefix">date_range</i>{{Form::text('date','', ['required'=>'required', 'placeholder' => ' ', 'class' => 'datepicker'])}}
        {{Form::label('date','Datum',['for'=>'datum'])}}
      </div>
  
      <div class="input-field col s12 l6">
      <i class="material-icons prefix">access_time</i>{{Form::text('time','', ['required'=>'required', 'placeholder' => ' ','class' => 'timepicker'])}}
        {{Form::label('time','Vreme',['for'=>'vreme'])}}
      </div>
  
      <event-select :cities="{{$cities}}"></event-select>
      
      <div class="row col s12 l4 offset-l8">
          <label class="right">      
            {{Form::checkbox('friends')}} <span>Obavestite prijatelje</span>
          </label>
      </div> 
    </div>
    
    <div class="row center align">
      {{Form::button('Napravi <i class="material-icons right">send</i>',['type'=>'submit', 'class'=>'btn s12 waves-effect waves-light'])}}
    </div>
    {!! Form::close() !!}
  
  </div>
</div>

@endsection