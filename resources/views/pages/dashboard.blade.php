@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card-panel">        
        

        <!-- ovo je vue.js komponenta gde pomocu propa saljemo neku vrednost-->
        <google-map city_name="{{Auth::user()->city->name}}" name="example">
        </google-map>
      <div class="row">
          <a href="{{route('dogadjaji')}}/create" class="btn">Napravi dogadjaj</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection