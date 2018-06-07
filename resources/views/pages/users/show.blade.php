@extends('layouts.app')
@section('content')


<div class="container">
  <div class="row">

    <!-- DEO SA LEVE STRANE -->
    <div class="col s12 m4">
      <div class="card blue-grey white-text">
        <div class="card-content center">
          
          <!-- SLIKA -->
          <div class="col s10 offset-s1">
          <img class="circle col s12" src="{{route('index')}}/storage/avatars/{{$user->user_img}}">  
          </div>
                                    
          <!-- PODACI, RATING -->
          <div class="row">
            <p class="card-title">
                {{$user->first_name}} 
                {{$user->last_name}}
            </p>              
            <p>              
              @if(Auth::user()->id == $user->id)          
              <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}" :readonly="true"></like-rating>

              @else       
              <like-rating :positive_ratings="{{$user->likeCount()}}" :negative_ratings="{{$user->dislikeCount()}}" :user_id="{{$user->id}}"></like-rating>
              @endif 
            </p>
            <p>
              <friendbutton :user_id="{{$user->id}}" :auth="{{Auth::user()->id}}" :status_input="{{Auth::user()->check($user->id)}}"></friendbutton> 
            </p>
          </div>          
          
        </div>
      </div>

      
    <!-- DODATNI PODACI -->      
    <ul id="profile-page-about-details" class="collection z-depth-1">
        
      <li class="collection-item">
          <div class="blue-grey-text text-lighten-2">Status
            <div class="secondary-content grey-text text-darken-4 right">{{$user->status}}</div>
          </div>                   
      </li>
      <li class="collection-item">
          <div class="blue-grey-text text-lighten-2">Prijatelji
          <div class="secondary-content grey-text text-darken-4 right">{{count($user->friends())}}</div>
          </div>                   
      </li>
      <li class="collection-item">
          <div class="blue-grey-text text-lighten-2">Kreirani Događaji
            <div class="secondary-content grey-text text-darken-4 right">{{count($user->events)}}</div>
          </div>                   
      </li>
      <li class="collection-item">
          <div class="blue-grey-text text-lighten-2">Grad
            <div class="secondary-content grey-text text-darken-4 right">{{$user->city->name}}</div>
          </div>                   
      </li>       
    </ul>

  </div>

    
    <!-- DEO SA DESNE STRANE -->
    <div class="col s12 m8">
      <div class="col s12 card">
          <div class="row">
              <div class="col s12">

                <!-- AKO JE NJEGOV NALOG-->
                @if(Auth::user()->id == $user->id)
                  <ul class="tabs">
                    <li class="tab col s4"><a href="#eventtab">Događaji</a></li>
                    <li class="tab col s4"><a href="#friendtab">Prijatelji</a></li>
                    <li class="tab col s4"><a href="#edittab">Izmeni</a></li>
                  </ul>                           
                  <div id="edittab" class="col s12">
                                        
                      {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                      
                      <div class="file-field input-field col s12 m8">
                        <div class="btn">
                          <span>Slika</span>
                          <input type="file" name="img">
                        </div>
                        <div class="file-path-wrapper">
                          <input class="file-path validate" type="text">
                        </div>
                      </div>
                      
                      <div class="input-field col s12 m4">
                        <select name="city_id">
                          @foreach($cities as $city)
                          <option value="{{$city->id}}" @if($user->city_id == $city->id) selected @endif>{{$city->name}}</option>
                          @endforeach
                        </select>
                        <label>Grad</label>
                      </div>

                      <div class="input-field col s12 m6">        
                        {{Form::text('first_name', $user->first_name)}}
                        {{Form::label('first_name', 'Ime', ['for'=>'first_name'])}}
                      </div>          
                      <div class="input-field col s12 m6">     
                        {{Form::text('last_name',$user->last_name)}}
                        {{Form::label('last_name', 'Prezime', ['for'=>'last_name'])}}
                      </div>                      
                      <div class="input-field col s12">        
                        {{Form::password('password')}}
                        {{Form::label('password','Nova Lozinka',['for'=>'password'])}}
                      </div>
                      <div class="input-field col s12">
                        {{Form::password('password_confirmation')}}
                        {{Form::label('password_confirmation','Potvrdite lozinku',['for'=>'password_confirmation'])}}
                      </div>    
                      <div class="row col s12 center">
                        {{Form::hidden('_method','PUT')}}
                        {{Form::button('Izmeni <i class="material-icons right">send</i>',['type'=>'submit', 'class'=>'btn s12 waves-effect waves-light'])}}
                      </div>
                      {!! Form::close() !!}
                  </div>
                <!-- AKO NIJE NJEGOV NALOG -->
                @else

                  <!-- AKO NIJE NJEGOV NALOG I ADMIN JE A NALOG NIJE OD ADMINA ILI JE SUPERADMIN -->
                  @if((Auth::user()->isAdmin() && !$user->isAdmin()) || Auth::user()->isSuperAdmin())
                  <ul class="tabs">
                    <li class="tab col s4"><a href="#eventtab">Događaji</a></li>
                    <li class="tab col s4"><a href="#friendtab">Prijatelji</a></li>
                    <li class="tab col s4"><a href="#admintab">Admin</a></li>
                  </ul>   
                  <div id="admintab" class="col s12">
                    
                    {!! Form::open(['action' => ['UserController@update', $user->id], 'method' => 'POST']) !!}
                    
                    @if(Auth::user()->isSuperAdmin())
                      <blockquote class="blue-grey-text text-lighten-2">
                        <b>Napomena:</b><br>
                        Dodeljivanjem statusa Super-Administratora nekom od korisnika vaš nalog će dobiti status Administratora. Budite sigurni da želite da napravite ovakvu izmenu.
                      </blockquote>
                    @endif
                    <div class="row">                      

                      <div class="col s6">
                        <label>
                          <input name="status" type="radio" value="Super-Admin"
                          @if(!Auth::user()->isSuperAdmin()) 
                          disabled                          
                          @endif
                          
                          @if($user->status == "Super-Admin") 
                          checked
                          @endif
                          />
                          <span 
                          @if(!Auth::user()->isSuperAdmin())
                          class="tooltipped"
                          data-position="top" 
                          data-tooltip="Nemate dovoljne administratorske privilegije za ovakvu izmenu"                          
                          @endif>Super-Admin</span>
                        </label>
                      </div>
                      <div class="col s6">
                        <label>
                          <input name="status" type="radio" value="Admin" 
                          @if(!Auth::user()->isSuperAdmin()) 
                          class="tooltipped"
                          data-position="top" 
                          data-tooltip="Nemate dovoljne administratorske privilegije za ovakvu izmenu"
                          disabled
                          @endif

                          @if($user->status == "Admin") 
                          checked
                          @endif
                          />
                          <span
                          @if(!Auth::user()->isSuperAdmin())
                          class="tooltipped"
                          data-position="top" 
                          data-tooltip="Nemate dovoljne administratorske privilegije za ovakvu izmenu"                          
                          @endif
                          >Admin</span>
                        </label>
                      </div>
                      <div class="col s6">
                        <label>
                          <input name="status" type="radio" value="Korisnik"
                          @if($user->status == "Korisnik") 
                          checked
                          @endif
                          />
                          <span>Korisnik</span>
                        </label>
                      </div>
                      <div class="col s6">
                        <label>
                          <input name="status" type="radio" value="Suspendovan"
                          @if($user->status == "Suspendovan") 
                          checked
                          @endif
                          />
                          <span>Suspendovan</span>
                        </label>
                      </div>
                    </div>

                      <div class="row center">
                        {{Form::hidden('_method','PUT')}}
                        {{Form::button('Izmeni Status',['type'=>'submit', 'class'=>'btn waves-effect waves-light'])}}
                      </div>

                    {!! Form::close() !!}                   
                  
                  </div>
                  <!-- AKO NIJE NJEGOV NALOG A NIJE ADMIN -->
                  @else
                  <ul class="tabs">
                    <li class="tab col s6"><a href="#eventtab">Događaji</a></li>
                    <li class="tab col s6"><a href="#friendtab">Prijatelji</a></li>
                  </ul>                  
                  @endif
                @endif  
                
                <div id="eventtab" class="col s12">
                    @if(count($user->attends()) > 0)
                    <div class = "row">
                      @foreach($user->attends() as $event)
                      <div class="col s12 l6">
                        <div class="card medium col-content z-depth-3" style="border: 1px solid {{$event->sport->color}}">
                          
                          <!-- SLIKA -->
                          <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="/img/{{$event->sport->image}}">
                            <span class="card-title activator">{{$event->localizedDate()}}, {{$event->getTimeNoSeconds()}}</span>
                          </div>
                
                          <!-- LINK -->
                          <div class="card-action center">                            
                            @if($event->isOver())
                              <a href="{{route('dogadjaji')}}/{{$event->id}}" class="card-title red-text">Završen</a>
                            @else
                              <a href="{{route('dogadjaji')}}/{{$event->id}}" class="card-title {{$event->sport->color}}-text">Detalji</a>
                            @endif
                          </div>
                          
                          <!-- TEKT U KARTICU -->
                          <div class="card-content">
                            <span class="card-title {{$event->sport->color}}-text">Kreirao:</span>
                            <a href="{{route('korisnici')}}/{{$event->user->id}}" class="black-text">{{$event->user->first_name}} {{$event->user->last_name}}</a>  
                          </div>
                          
                          <!-- TEXT STO ISKACE -->
                          <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">{{$event->sport->name}}<i class="material-icons right">close</i></span>
                            <div class="row">              
                              <h6>Pridruženi korisnici:</h6>
                              <span>{{$event->attendsCount()}}</span>
                              <h6>Adresa:</h6>
                              <span>{{$event->court->name()}}</span><br>
                              <span>{{$event->court->address()}}, {{$event->court->city->name}}</span>
                              <h6>Ocena terena:</h6>
                              <star-rating :inline="true" :read-only="true" :rating="{{$event->court->averageGrade()}}" :round-start-rating="false" :star-size="25"></star-rating>
                              <h6>Vaša ocena:</h6>
                              <star-rating :inline="true" :read-only="true" :rating="{{Auth::user()->courtRating($event->court->id)}}" :round-start-rating="false" :star-size="25"></star-rating>
                            </div>
                          </div>
                
                        </div>      
                      </div>
                      @endforeach    
                  </div>
                  @else
                  <div class="row center blue-grey-text text-lighten-2">
                    <h4>Trenutno nema događaja kojima je pridružen</h4>
                  </div>
                  @endif

                </div>
                <div id="friendtab" class="col s12">
                  <friend-list :users={!! json_encode($user->friends()) !!} :size=14></friend-list>
                </div>            
            </div>
          </div>
      </div>      
    </div>
    
  </div>
</div>

@endsection