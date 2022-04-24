<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/ucn.ico" type="image/x-icon">
    <title>Seleccionar Asignatura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
</head>
<body>   
    <nav class ="navbar navbar-light navbar-expand-md fixed-top" style ="background-color: #003057"  >
        <a class = "btn" href="{{url('/Ayudante-home')}}" style="color:#fff">
            <img src="/images/flechaVolver.png" alt="Logo UCN" width="50px" height="auto"> 
        </a>
        <div class="container" >
         <a href="https://ucn.cl" class="navbar-brand">
          <img src="/images/logo_ucn_fondo_oscuro.png" alt="Logo UCN" width="400px" height="auto">
         </a>                
        </div>

    </nav>
    


    <section class="container d-flex py-4 mt-5">
        <!--- Esto existe para separar el título de la nav-bar, sin esto el titulo queda pegado -->
        <div class="container d-flex justify-content-center py-4 mt-5"> 
        <br>
        <h1>Asignaturas con encuestas</h1>
        </div>
        <br>
        
        <br>
    </section>
    <div class="py-2 mt-2 text-center justify-content-center">
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif 
    </div>
    <section class = "d-flex py-2 mt-2 justify-content-center">
        
        <div class= " d-flex justify-content-center scrollable" id="bg">

            <table  class="table table-responsive table-bordered" , border ="2">
            <thead>
                <tr>
                    <td>NRC</td>
                    <td class= "col-10 text-center">Operación</td>
                    
                    

                <tr>

                @foreach ($encuestas as $encuesta)
                <tr>
                    <div>
                    <td>{{$encuesta->nrc_asignatura}}</td>
                    <td><a class = "btn btn-primary" href="{{route('Desplegar',$encuesta->nrc_asignatura)}}">Detalles encuesta</a></td>
                    
                    
                    
                    </div>
                
                </tr>
                @endforeach
            </thead>
            </table>

        </div>
    </section>
</body>
</html>
