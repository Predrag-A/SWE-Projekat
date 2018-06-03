@extends('layouts.app')
@section('content')

<div class="container">
  <h3>Korisnici</h3>

  <div class = "center">
  @if(count($users) > 0)  
  <div class = "row">
      @foreach($users as $user)
      <div class="col s12 l6">
        <div class="horizontal card col-content z-depth-3">

          <div class="card-image">
            <img style="height:100px" src="{{route('index')}}/storage/avatars/{{$user->user_img}}">
          </div>

          <div class="container">       
            <div class="left-align">   
              <a href="{{route('korisnici')}}/{{$user->id}}" class="blue-text text-darken-2"><b>{{$user->first_name}} {{$user->last_name}}</b></a>
            </div>
            <div class="left-align">
              <i class="material-icons tiny">home</i>
              <i>{{$user->city->name}}</i>
            </div>
            <div class="left-align">
              <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}" :readonly="true"></like-rating>
            </div>
            <div class="right">
            <friendbutton :user_id="{{$user->id}}" :auth="{{Auth::user()->id}}" :status_input={{Auth::user()->check($user->id)}}></friendbutton>
            </div>

          </div>

        </div>
      </div>
      @endforeach
  </div>
  <div class="row">    
    {!! $users->render() !!}
  </div>
  @else
  <p>Trenutno nema kreiranih naloga.</p>
  @endif

  </div>

</div>

@endsection