@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card-panel">        
        <h5>Content PH</h5>
        <!-- Provera za relaciju -->
        <!-- ovo je vue.js komponenta gde pomocu propa saljemo neku vrednost-->
        <dashboard-component city_prop="{{Auth::user()->city->name}}">
        </dashboard-component>
      </div>
    </div>
  </div>
</div>

@endsection