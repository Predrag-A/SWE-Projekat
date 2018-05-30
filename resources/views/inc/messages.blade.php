@if(count($errors) > 0)
  @foreach($errors->all() as $error)  
  <script>
     M.toast({html: '{{$error}}', classes: 'red lighten-3'});
  </script>
  @endforeach
@endif

@if(session('success'))  
  <script>
      M.toast({html: '{{session('success')}}', classes: 'green lighten-3'});
  </script>
@endif

@if(session('error'))  
  <script>
    M.toast({html: '{{session('error')}}', classes: 'red lighten-3'});
  </script>
@endif