@extends('layouts.app')
@section('content')

<div class="container">
  <ul class = "collection with-header">
    <li class="collection-header">
      Pretraga ide ovde PH
    </li>
    @foreach($users as $user)
    
    <li class="collection-item avatar">

      <!-- SLIKA -->
      <img class="circle" src="{{route('index')}}/storage/avatars/{{$user->user_img}}"> 

      <!-- PODACI -->
      <a href="{{route('korisnici')}}/{{$user->id}}" class="blue-text text-darken-2 title"><b>{{$user->first_name}} {{$user->last_name}}</b></a>
      <p>
        <i class="material-icons tiny">home</i>
        <i>{{$user->city->name}}</i>
        <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}" :readonly="true"></like-rating>        
        <friendbutton class="hide-on-med-and-up" :user_id="{{$user->id}}" :auth="{{Auth::user()->id}}" :status_input={{Auth::user()->check($user->id)}}></friendbutton>
      </p>

      <!-- DUGME -->          
      <span class="secondary-content hide-on-small-only">
        <friendbutton :user_id="{{$user->id}}" :auth="{{Auth::user()->id}}" :status_input={{Auth::user()->check($user->id)}}></friendbutton>
      </span>

    </li>
    @endforeach
  </ul>
  <div class="row center">    
    {!! $users->render() !!}
  </div>

</div>

@endsection