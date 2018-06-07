@extends('layouts.app')
@section('content')

<div class="container">
  
  @if(count($notifications) > 0) 

  <ul class="collapsible expandable">
    @foreach($notifications as $notification)
    <notification :notification="{{$notification}}" :sender="{{$notification->sender}}"></notification>
    @endforeach    
  </ul>
  <div class="row center">    
    {!! $notifications->render() !!}
  </div>
  @else
  
  <div class="row center blue-grey-text text-lighten-2">
    <h4>Trenutno nemate notifikacije</h4>
  </div>

  @endif
</div>

@endsection