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
          
          <!-- PRIJATELJI -->
          <friendbutton :user_id="{{$user->id}}" :auth="{{Auth::user()->id}}"></friendbutton>

          <!-- OCENJIVANJE -->          
          @if(Auth::user()->id == $user->id)          
          <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}" :readonly="true"></like-rating>

          @else       
          <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}"></like-rating>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>

@endsection