@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="col s12">
      <div class="card-panel">        
        <h5>Content PH</h5>
        <!-- Provera za relaciju -->
        Grad: {{Auth::user()->city->name}}
      </div>
    </div>
  </div>
</div>

@endsection