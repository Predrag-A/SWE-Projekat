@extends('layouts.app')
@section('content')

<div class="container">
  <h1>FAQ</h1>
  <blockquote class="blue-grey-text text-lighten-2">
      Ovo su najčešće postavljena pitanja. Ako imate dodatnih pitanja slobodno nas kontaktirajte.
  </blockquote>
  <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Da li je registracija besplatna?</div>
      <div class="collapsible-body"><span>Da, registracija je skroz besplatna!</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Second</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Third</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
    </li>
  </ul>
</div>

@endsection