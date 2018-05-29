@extends('layouts.app')
@section('content')


<div class="container">
  <div class="col s12 m6">
    <div class="card blue-grey">
      <div class="card-content white-text">
        <div class="row">
          <h3>{{$user->first_name}} {{$user->last_name}}</h3>
          <p>{{$user->status}}</p>

          @if(Auth::user()->id == $user->id)

          <a href= "{{route('korisnici')}}/{{$user->id}}/edit" class = "waves-effect waves-light btn">Izmeni</a>

          @endif        
          
          <!-- Prijatelji -->
          <friendbutton :user_id="{{$user->id}}" :auth="{{Auth::user()->id}}"></friendbutton>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection