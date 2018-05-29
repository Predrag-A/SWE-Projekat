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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  </head>
  <body>   
  @include('inc.navbar')

  <main id="app">

  @yield('content')    

  </main>
  @include('inc.footer')

 
  <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHDn0g1BXhnxXr0-d12cfzhdHF2j7KgPM">
    </script>
  <script src="/js/app.js"></script> <!-- sa ovim se ukljucuje vue.js ili bilo koja JS skripta -->  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>     

  <script>      
    
    

    $( document ).ready(function() {  
      $('.parallax').parallax();
      $('.modal').modal();      
      $('.sidenav').sidenav();
      $(".dropdown-trigger").dropdown({
        coverTrigger: false
      });
      $('select').formSelect();
      $('.datepicker').datepicker({ 
          minDate: new Date(),
          firstDay: true, 
          format: 'yyyy-mm-dd',
          i18n: {
              months: ['Januar', 'Februar', 'Mart', 'April', 'Maj', 'Jun', 'Jul', 'Avgust', 'Septembar', 'Oktobar', 'Novembar', 'Decembar'],
              monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Maj', 'Jun', 'Jul', 'Avg', 'Sep', 'Okt', 'Nov', 'Dec'],
              weekdays: ['Ponedeljak', 'Utorak', 'Sreda', 'Četvrtak', 'Petak', 'Subota', 'Nedelja'],
              weekdaysShort: ['Pon', 'Uto', 'Sre', 'Čet', 'Pet', 'Sub', 'Ned'],
              weekdaysAbbrev: ["P","U", "S", "Č", "P", "S", "N"],
              cancel: 'Nazad'
          }
      });     
      $('.timepicker').timepicker({
        twelveHour:false
      });
    });
  </script>
  @include('inc.messages')
  
</body>
</html>