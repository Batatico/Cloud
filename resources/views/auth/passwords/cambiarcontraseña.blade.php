<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="images/ucn.ico" type="image/x-icon">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-migrate-3.3.2.js"></script>
        <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
        <title>Plataforma Ayudantes-PASSWORD</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <img src="{{ asset('images/foto.JPG') }}" alt="mi foto">
        
    </head>
    <body>
    <nav class ="navbar navbar-light navbar-expand-md fixed-top" style ="background-color: #003057"  >
        <a class = "btn" href="{{url('/docente-home')}}" style="color:#fff">
        <img src="/images/flechaVolver.png" alt="Logo UCN" width="50px" height="auto"> 
        </a> 
        <div class="container" >
         <a href="https://ucn.cl" class="navbar-brand">
          <img src="/images/logo_ucn_fondo_oscuro.png" alt="Logo UCN" width="400px" height="auto">
         </a>                
        </div>
      </nav>

      <section class="form-register">
      <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            </div>
        @endif
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{route('cambiarP')}}" method="post">
        @csrf
        {{method_field('PATCH')}}
        <h4 class ="text-center">Cambiar Contraseña</h4>
            <input class="controls" type="text" name="rut" id="rut" placeholder="{{ auth()->user()->rut }}" value='{{ auth()->user()->rut }}' readonly>
            <input class="controls" type="text" name="password" id="password" placeholder="Nueva Contraseña " required>
            <!--<input class="controls" type="text" name="password1" id="password1" placeholder="Confirme Contraseña " required>
-->
            <input class="botons" type="submit" value="Editar">
        </form>    
        </section>





    <!-- Archivos bootstrap JAVASCRIPT -->  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    </body>

</html>