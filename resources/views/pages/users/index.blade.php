@extends('layouts.app')
@section('content')

<div class="container">

  {!! Form::open(['action' => ['UserController@search'], 'method' => 'GET']) !!}
    <div class="row">
      <div class="col s3 m2 l1" style="padding-top:10px;">
        <button class="btn-floating btn-large waves-effect waves-light" type="submit"><i class="material-icons">search</i></button>
      </div>
      <div class="input-field col s9 m10 l11">          
        <input id="search" type="search" name="query" placeholder="Pretraga" required>
        <i class="material-icons">close</i>
      </div>
    </div>
  {!! Form::close() !!}

  @if(count($users) > 0)
  <ul class = "collection row">
    @foreach($users as $user)

    <!-- DODATNA ZASTITA -->
    @if($user->id != Auth::user()->id)
    
    <li class="collection-item avatar col s12 l6">

      <!-- SLIKA -->
      <img class="circle" src="{{route('index')}}/storage/avatars/{{$user->user_img}}" style="margin-top:25px;"> 

      <div style="padding-top:10px;">
        <!-- PODACI -->
        <a href="{{route('korisnici')}}/{{$user->id}}" class="blue-text text-darken-2 title"><b>{{$user->first_name}} {{$user->last_name}}</b></a>
        <p>
          <i class="material-icons tiny">home</i>
          <i>{{$user->city->name}}</i>
          <div style="padding-left:13px">
            <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}" :readonly="true"></like-rating>       
          </div> 
        </p>
      </div>

      <!-- DUGME -->          
      <span class="secondary-content" style="margin-top:17px;">
        <friendbutton :userid="{{$user->id}}" :statusinput={{Auth::user()->check($user->id)}} :cancelvisible="false"></friendbutton>
      </span>

    </li>
    @endif

    @endforeach
  </ul>
  <div class="row center col s12">    
    {!! $users->render() !!}
  </div>
  @else
  <div class="row center blue-grey-text text-lighten-2">
    <h4>Nije pronađen nijedan korisnik</h4>
  </div>
  @endif

</div>

@endsection