@extends('layouts.app')
@section('content')

<div class="row">
  <div class="col s12">  
    <ul class="tabs">
      <li class="tab col s4"><a href="#swipe-1">Korisnici</a></li>
      <li class="tab col s4"><a href="#swipe-2">Zahtevi</a></li>
      <li class="tab col s4"><a href="#swipe-3">Dodavanje</a></li>
    </ul>
  </div>
<div id="swipe-1" class="col s12 blue">
    <table>
        <thead>
          <tr>
              <th>Ime i Prezime</th>
              <th>E-mail Adresa</th>
              <th>Status</th>
          </tr>
        </thead>

        <tbody>               
          @foreach($users as $user)
          <tr>
            <td>{{$user->first_name}} {{$user->last_name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->status}}</td>
          </tr>  
          @endforeach
        </tbody>
        <div class="row">    
            {!! $users->render() !!}
        </div>
      </table>
</div>
<div id="swipe-2" class="col s12 red">Test 2</div>
<div id="swipe-3" class="col s12 green">Test 3</div>
</div>

@endsection