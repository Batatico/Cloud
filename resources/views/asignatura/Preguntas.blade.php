<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/ucn.ico" type="image/x-icon">
    <title>VerPreguntas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
</head>
<body>
    <nav class ="navbar navbar-light navbar-expand-md fixed-top" style ="background-color: #003057"  >
    <a class = "btn" href="{{url('/encuesta/crear')}}" style="color:#fff">
    <img src="/images/flechaVolver.png" alt="Logo UCN" width="50px" height="auto"> 
    </a>
    
    <div class="container">
         <a href="https://ucn.cl" class="navbar-brand">
          <img src="/images/logo_ucn_fondo_oscuro.png" alt="Logo UCN" width="400px" height="auto">
         </a>
        </div>
      </nav>

      

    <section class="container d-flex py-4 mt-5">
        <!--- Esto existe para separar el título de la nav-bar, sin esto el titulo queda pegado -->
        <div class="container d-flex justify-content-center", style="padding-top:100px; ">
        <h1> Ver Preguntas </h1>

        </div>
    </section>

    <section class="container py-1 mt-1 justify-content-center", style="padding-top:60px; ">
        <div>
            <div class="row justify-content-center">
                <div class="col-6 card justify-content-center">
                    <div class="py-2 mt-2 text-center justify-content-center">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                        </div>
                        @endif

                        @if(!empty($successMsg))
                        <div class="alert alert-success"> {{ $successMsg }}</div>
                        @endif

                        @if(!empty($errorMsg))
                        <div class="alert alert-danger"> {{ $errorMsg }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                       
                        <form action="{{url('/preguntas/')}}" method="post">
                            @csrf

                            <!-- nombre_pregunta -->
                          
                            <div class= "container d-block align-content-center">
                            
                            </div>
                            <div class= "container d-block align-content-center" >
                            
                            <h4>Nombre de la pregunta</h4>
                            <x-input id="pregunta" required class="block mt-1 w-full" type="text" name="pregunta"/>
                            <h4>ID Encuesta</h4>
                            <x-input id="id_encuesta" required class="block mt-1 w-full" type="number" name="id_encuesta" value={{$id_encuesta}} readonly/>
                            <h4> Tipo de Indicador </h4>
                            <select required class="" id="indicador" type="text" name="indicador" :value="old('indicador')" >
                                <option selected disabled value="0" require> Elige una opción </option>
                                <option value="1">Indicador 1</option>
                                <option value="2" >Indicador 2</option>
                            </select>
                            </div>

                            <x-button class="ml-4 mt-2 btn btn-success" >
                                {{method_field('POST')}}
                                Agregar Preguntas
                            </x-button>
                            </div>

                         </form>
                        
                    </div>
                </div>                

            </div>
        </div>
    </section>

    <div class="container col-12 card-header py-2 mt-2 text-center justify-content-center">
        <h3>Preguntas</h3>

    </div>

    <section class = "d-flex py-2 mt-2 justify-content-center">

        <div class= " d-flex justify-content-center scrollable" id="bg">

        <table  class="table table-responsive table-bordered" , border ="2">
        <thead>
            <tr>
                <td>N° de pregunta</td>
                <td>Pregunta</td>
                <td>Indicador</td>
                <td>Operaciones</td>
            <tr>
            @foreach ($preguntas as $pregunta)
            <tr>

                <td>{{$pregunta['id_pregunta']}}</td>
                <td>{{$pregunta['pregunta']}}</td>
                <td>{{$pregunta['indicador']}}</td>
                <td>
                    <div class= "text-center">
                        <div class="btn-group">
                            <form action="{{url('/preguntas/'.$pregunta->id_pregunta)}}" method="post">
                             @csrf
                            {{ method_field('DELETE')}}
                                <button class = "btn btn-danger"> Eliminar </button>

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
