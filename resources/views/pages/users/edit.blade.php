@extends('layouts.app')
@section('content')

<div class="container">
  
  <div class="row">
    <h1>Izmena</h1>
    {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="input-field col s12 m6">        
      {{Form::text('first_name', $user->first_name, ['required'=>'required'])}}
      {{Form::label('first_name', 'Ime', ['for'=>'first_name'])}}
    </div>          
    <div class="input-field col s12 m6">     
      {{Form::text('last_name',$user->last_name, ['required'=>'required'])}}
      {{Form::label('last_name', 'Prezime', ['for'=>'last_name'])}}
    </div>
    <div class = "row">
      {{Form::file('img')}}
    </div>
      {{Form::hidden('_method','PUT')}}
      {{Form::submit('Potvrdi', ['class' => 'waves-effect waves-light btn'])}}
    {!! Form::close() !!}
  </div>
</div>

@endsection