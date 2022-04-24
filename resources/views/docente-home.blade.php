<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/ucn.ico" type="image/x-icon">
    <title>DashboardEncargadoDocente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.3.2.js"></script>
    <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
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
        
        <a class = "btn" href="{{route('cambioClave')}}" style="color:#fff"> Cambiar Contraseña </a>
        <form method="POST" action="{{ route('logout') }}">
        @csrf
        
        <a class = "btn" href="{{route('logout')}}" style ="color:#fff" onclick="event.preventDefault();this.closest('form').submit();"> Cerrar sesion </a>
        
        </form>


      </nav>

      <section class="container d-flex py-4 mt-5">
        <!--- Esto existe para separar el título de la nav-bar, sin esto el titulo queda pegado -->
        <div class="container d-flex justify-content-center py-4 mt-5"> 
        <h1> ¡Bienvenido Encargado Docente! </h1>
        </div>
       </section>


    <section class=" container py-1 mt-1 justify-content-center", style="padding-top:60px; ">
        <div>
            <div class="row justify-content-center">
                <div class="card justify-content-center">
                    <div class="card-header py-2 mt-2 text-center justify-content-center">
                       <h3> --Puede realizar las siguientes actividades-- </h3>

                    </div>
                    <div class= "d-flex card-body py-4 mt-4 justify-content-between">
                        
                        <button class="btn btn-success btn-lg" type="button" onclick="window.location='{{ url("/periodo") }}'">Habilitar Periodo Académico</button>
                        <button class="btn btn-success btn-lg" type="button" onclick="window.location='{{ url("/import-alumno") }}'">Carga Masiva Alumnos</button>
                        <button class="btn btn-success btn-lg" type="button" onclick="window.location='{{ url("/import-asignatura") }}'">Carga Masiva Asignaturas</button>                        
                        <button class="btn btn-success btn-lg" type="button" onclick="window.location='{{ url("/asignatura") }}'">Administrar Asignaturas</button>
                    </div>

                    <div class= "d-flex card-body py-4 mt-4 justify-content-between">
                        
                        <button class="btn btn-success btn-lg" type="button" onclick="window.location='{{ url("/import-ayudante") }}'">Asignar Ayudantes</button>
                        <button class="btn btn-success btn-lg" type="button" onclick="window.location='{{ url("/import-contenedor-asignatura") }}'">Asignar Estudiantes</button>
                        <button class="btn btn-success btn-lg" type="button" onclick="window.location='{{ url("/encuesta/crear") }}'">Crear Encuesta</button>
                        <button class="btn btn-success btn-lg" type="button" onclick="window.location='{{ url("/encuesta/asociar") }}'">Asociar Encuesta</button>

                    </div>

                    <div class= "d-flex card-body py-4 mt-4 justify-content-center">
                        
                        <button class="btn btn-success btn-lg" type="button" onclick="window.location='{{ url("/graficos") }}'">Gráficos</button>                        

                    </div>                                                             
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    
</body>
</html>