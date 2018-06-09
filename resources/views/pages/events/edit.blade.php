@extends('layouts.app')
@section('content')

<div class="container">
  
  <h1>Izmeni dogadjaj</h1>
    {!! Form::open(['action' => ['EventController@update', $event->id], 'method' => 'POST']) !!}
    
  <div class="row col s12 m16">
    <div class="input-field col s12 m6">
      {{Form::text('date', $event->getDate(), ['required'=>'required', 'class' => 'datepicker'])}}
      {{Form::label('date','Datum',['for'=>'datum'])}}
    </div>

    <div class="input-field col s12 m6">
      {{Form::text('time', $event->getTime(), ['required'=>'required','class' => 'timepicker'])}}
      {{Form::label('time','Vreme',['for'=>'vreme'])}}
    </div>
    
    <event-select :cities="{{$cities}}"></event-select>
   
  <div class="row center align">
    
    {{Form::hidden('_method','PUT')}}
    {{Form::button('Potvrda <i class="material-icons right">send</i>',['type'=>'submit', 'class'=>'btn s12 blue darken-4 waves-effect waves-light'])}}
  </div>
  {!! Form::close() !!}

</div>



@endsection