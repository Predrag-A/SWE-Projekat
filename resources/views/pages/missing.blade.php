<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'INT')}}</title>

    <link rel="stylesheet" href="{{asset('css/app.css')}}">  
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  </head>
   
<body class="green lighten-2">  

  
  <div class="content">
    <div class="row">
      <div id="site-layout-example-top" class="col s12">
        <p class="flat-text-logo center white-text caption-uppercase">404; Nismo mogli da pronađemo stranicu</p>
      </div>
      <div id="site-layout-example-right" class="col s12 m12 l12">
        <div class="row center">
          <h1 class="white-text text-long-shadow col s12"><i class="large material-icons">sentiment_very_dissatisfied</i></h1>
          <iframe width="640" height="480" wmode="transparent" src="//www.youtube.com/embed/ocW3fBqPQkU" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="row center">
          <p class="center white-text col s12">Izgleda da stranica ne postoji.</p>
          <p class="center s12"><button onclick="goBack()" class="btn waves-effect waves-light">Nazad</button> <a href="{{route('dashboard')}}" class="btn waves-effect waves-light">Početna strana</a>
            <p>
            </p>
        </div>
      </div>
    </div>
  </div> 

</body>

 
  <script type="text/javascript">
    function goBack() {
      window.history.back();
    }
  </script>
  <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHDn0g1BXhnxXr0-d12cfzhdHF2j7KgPM">
  </script>
  <script src="/js/app.js"></script> <!-- sa ovim se ukljucuje vue.js ili bilo koja JS skripta -->  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>     

</html>
