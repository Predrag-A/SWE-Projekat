@extends('layouts.app')
@section('content')

<div class="container">
  <h1>Tereni</h1>
  <p>
    @foreach($courts as $court)
      <p>
        {{$court->location}}
      </p>
    @endforeach
  </p>
</div>

@endsection