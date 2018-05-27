@extends('layouts.app')
@section('content')

<!-- ovo je vue.js komponenta gde pomocu propa saljemo neku vrednost-->
<google-map name="serbia"></google-map>
<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card-panel">        
      <div class="row">
          <a href="{{route('dogadjaji')}}/create" class="btn">Napravi dogadjaj</a>   
        </div>
      </div>
    </div>
  </div>
</div>

@endsection