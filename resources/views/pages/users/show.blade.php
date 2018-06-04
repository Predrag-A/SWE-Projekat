@extends('layouts.app')
@section('content')


<div class="container">
  <div class="card blue-grey">
    <div class="card-content white-text">
      <div class="row">
        <h3>{{$user->first_name}} {{$user->last_name}}</h3>
        <p>{{$user->status}}</p>

        @if(Auth::user()->id == $user->id)

        <a href= "{{route('korisnici')}}/{{$user->id}}/edit" class = "waves-effect waves-light btn">Izmeni</a>

        @endif        
        
        <!-- PRIJATELJI -->
        <friendbutton :user_id="{{$user->id}}" :auth="{{Auth::user()->id}}" :status_input="{{Auth::user()->check($user->id)}}"></friendbutton>

        <!-- OCENJIVANJE -->          
        @if(Auth::user()->id == $user->id)          
        <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}" :readonly="true"></like-rating>

        @else       
        <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}"></like-rating>
        @endif         

      </div>
    </div>
  </div>
  <div class="row">
    <div class="col s12 m7 card">
      <div class="card-content">Temp</div>
    </div>

    <div class="col s12 m5 card">              
      <!-- LISTA PRIJATELJA -->
      <div class="row center blue-grey-text text-lighten-2">
        <h5>Prijatelji:</h5>
      </div>
      <friend-list :users={!! json_encode($user->friends()) !!} :size=9></friend-list>
    </div>
    
  </div>
</div>

@endsection