@extends('layouts.app')
@section('content')


<div class="container">
  <div class="row">
  
    <div class="card blue-grey white-text col s12">
      <div class="card-content">

        <!-- DEO SA SLIKOM -->
        <div class="col s4 l2 center">

          <!-- SLIKA -->
          <img class="circle col s12" src="{{route('index')}}/storage/avatars/{{$user->user_img}}">             

          <!-- OCENJIVANJE -->          
          <div class="row col s12">
            <p>{{$user->status}}</p>
            @if(Auth::user()->id == $user->id)          
            <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}" :readonly="true"></like-rating>

            @else       
            <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}"></like-rating>
            @endif                     
          </div>
        </div> 
        
        <!-- OSTALI INFO -->
        <div class="col s8 l10">
          <div class="card-title">{{$user->first_name}} {{$user->last_name}}</div>          

          @if(Auth::user()->id == $user->id)

          <a href= "{{route('korisnici')}}/{{$user->id}}/edit" class = "waves-effect waves-light btn">Izmeni</a>

          @endif 
        </div>
        
      </div>
    </div>

    <div class="col s12 m8 card">
      <div class="card-content">Temp</div>
    </div>

    <div class="col s12 m4 card">
      <!-- LISTA PRIJATELJA -->
      <div class="row center blue-grey-text text-lighten-2">
        <h5>Prijatelji:  {{count($user->friends())}}</h5>
      </div>
      <friend-list :users={!! json_encode($user->friends()) !!} :size=9></friend-list>      
      <!-- PRIJATELJI -->
      <friendbutton :user_id="{{$user->id}}" :auth="{{Auth::user()->id}}" :status_input="{{Auth::user()->check($user->id)}}"></friendbutton> 
    </div>
   
  </div>
</div>

@endsection