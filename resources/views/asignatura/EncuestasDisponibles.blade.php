<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/ucn.ico" type="image/x-icon">
    <title>Encuestas Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
</head>
<body>
<nav class ="navbar navbar-light navbar-expand-md fixed-top" style ="background-color: #003057"  >
    <a class = "btn" href="{{url('/docente-home')}}" style="color:#fff">
    <img src="/images/flechaVolver.png" alt="Logo UCN" width="50px" height="auto"> 
    </a>
        <div class="container" >
         <a href="localhost:8000" class="navbar-brand">
          <img src="/images/logo_ucn_fondo_oscuro.png" alt="Logo UCN" width="400px" height="auto">
         </a>                
        </div>


</nav>
       

    <section class="container d-flex py-4 mt-5">
        <!--- Esto existe para separar el título de la nav-bar, sin esto el titulo queda pegado -->
        <div class="container d-flex justify-content-center", style="padding-top:100px; ">
        <h1> Encuestas Disponibles </h1>

        </div>
    </section>
    <section class = "d-flex py-2 mt-2 justify-content-center">
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
        {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            @if(is_array(session('success')))
                    @foreach (session('success') as $message)
                        {{ $message }}
                    @endforeach
            @else
                {{ session('success') }}
            @endif
        </div>
        @endif
    </section>
    <section class = "d-flex py-2 mt-2 justify-content-center">

        <div class= " d-flex justify-content-center scrollable" id="bg">

        <table  class="table table-responsive table-bordered" , border ="2">
        <thead>
            <tr>
                <td>NRC de Asignaturas</td>
            <tr>
            @foreach ($asignaturas as $asignatura)
            <tr>

                <td>{{$asignatura->nrc_asignatura}}</td>
                <td>
                    <div class= "text-center">
                        <div class="btn-group">
                            <form action="{{url('/responder/'.$asignatura->nrc_asignatura.'/edit')}}" method="post">
                             @csrf
                            {{ method_field('GET')}}
                                <button class = "btn btn-success"> Responder Encuesta</button>

                            </form>
                        </div>
                    </div>
                    
                </td>
            </tr>
            @endforeach
        </thead>
        </table>

        </div>
    </section>

    
</body>
</html>
