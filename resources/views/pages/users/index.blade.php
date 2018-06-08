@extends('layouts.app')
@section('content')

<div class="container">

  <form action="{{ route('usersearch') }}" method="post">
    {{csrf_field()}}        
    <div class="row">
      <div class="col s3 m2 l1" style="padding-top:10px;">
        <button class="btn-floating btn-large" type="submit"><i class="material-icons">search</i></button>
      </div>
      <div class="input-field col s9 m10 l11">          
        <input id="search" type="search" name="searchData" required>
        <i class="material-icons">close</i>
      </div>
    </div>
  </form>

  @if(count($users) > 0)
  <ul class = "collection row">
    @foreach($users as $user)
    
    <li class="collection-item avatar col s12 l6">

      <!-- SLIKA -->
      <img class="circle" src="{{route('index')}}/storage/avatars/{{$user->user_img}}"> 

      <!-- PODACI -->
      <a href="{{route('korisnici')}}/{{$user->id}}" class="blue-text text-darken-2 title"><b>{{$user->first_name}} {{$user->last_name}}</b></a>
      <p>
        <i class="material-icons tiny">home</i>
        <i>{{$user->city->name}}</i>
        <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}" :readonly="true"></like-rating>        
      </p>

      <!-- DUGME -->          
      <span class="secondary-content">
        <friendbutton :userid="{{$user->id}}" :statusinput={{Auth::user()->check($user->id)}}></friendbutton>
      </span>

    </li>
    @endforeach
  </ul>
  <div class="row center">    
    {!! $users->render() !!}
  </div>
  @else
  <div class="row center blue-grey-text text-lighten-2">
    <h4>Nije pronađen nijedan korisnik</h4>
  </div>
  @endif

</div>

@endsection