@extends('layouts.app')
@section('content')

<div class="container">
  <h3>Korisnici</h3>

  <div class = "center">
  @if(count($users) > 0)  
  <div class = "row">
      @foreach($users as $user)
      <a a href="{{route('korisnici')}}/{{$user->id}}" class="card col s12 l6">
        <div class="card-content">
          <div class="card-title black-text">{{$user->first_name}} {{$user->last_name}}</div>
        </div>
      </a>
        
      @endforeach
      {{$users->render()}}
  </div>
  @else
  <p>Trenutno nema kreiranih naloga.</p>
  @endif

  </div>

</div>

@endsection