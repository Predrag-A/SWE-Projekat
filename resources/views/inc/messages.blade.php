@if(count($errors) > 0)
  @foreach($errors->all() as $error)  
  <script>
     Materialize.toast('{{$error}}', 4000, 'red lighten-3')
  </script>
  @endforeach
@endif

@if(session('success'))  
  <script>
      Materialize.toast('{{$session('success')}}', 4000, 'green lighten-3')
  </script>
@endif

@if(session('error'))  
  <script>
    Materialize.toast('{{$session('error')}}', 4000, 'red lighten-3')
  </script>
@endif