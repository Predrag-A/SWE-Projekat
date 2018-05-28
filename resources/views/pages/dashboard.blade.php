@extends('layouts.app')
@section('content')

<!-- ovo je vue.js komponenta gde pomocu propa saljemo neku vrednost-->
<google-map name="serbia" createbtnurl="{{route('dogadjaji')}}/create"></google-map>

@endsection