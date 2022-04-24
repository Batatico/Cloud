<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/ucn.ico" type="image/x-icon">
    <title>Responder Encuesta</title>
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
        <h1> Responder Encuesta </h1>

        </div>
    </section>
    <section>

    <div class="form-group">

        
            <h3>{{$encuesta->nombre_encuesta}}</h3>
        <div class="mt-5"> 
            <form action="{{route('responder.store',$encuesta->id_encuesta)}}" method="post">
            @csrf
            {{method_field('POST')}}

            <label for="nombre_encuesta" class="col-md-4 col-form-label text-md-right">Nombre del Ayudante</label>
                
                    <div class="col-md-6">
                       
                        <select id="rut_ayudante" type="select" name="rut_ayudante" >
                             @foreach ($ayudantes as $ayudante)
                            <option selected value="{{$ayudante->rut_alumno}}">{{$ayudante->nombre}}</option>
                            @endforeach
                
                        </select>
                    </div>

            <br></br>
            @foreach($preguntas as $pregunta)
            <div class="checkbox">

                <h3 >{{$pregunta->pregunta}}</h3>
                <br>
                @if($pregunta->indicador == 1)
                    <input required type="radio" name="{{$pregunta->id_pregunta}}" value="Totalmente de acuerdo">
                    Totalmente de acuerdo
                     <br>
                     <input required type="radio" name="{{$pregunta->id_pregunta}}" value="De acuerdo">
                     De acuerdo
                     <br>
                     <input required type="radio" name="{{$pregunta->id_pregunta}}" value="Ni de acuerdo ni en desacuerdo">
                     Ni de acuerdo ni en desacuerdo
                     <br>
                     <input required type="radio" name="{{$pregunta->id_pregunta}}" value="En desacuerdo">
                     En desacuerdo 
                     <br>
                     <input required type="radio" name="{{$pregunta->id_pregunta}}" value="Totalmente en desacuerdo">
                     Totalmente en desacuerdo
                     <br>
                     <input required type="radio" name="{{$pregunta->id_pregunta}}" value="No aplica">
                     No aplica
                     <br>
                 
                @elseif ($pregunta->indicador == 2) <!--Indicador = 2 -->
                    <input required type="radio" name="{{$pregunta->id_pregunta}}" value="Si">
                     Sí
                     <br>
                    <input required type="radio" name="{{$pregunta->id_pregunta}}" value="No">
                     No 
                     <br>
                    <input required type="radio" name="{{$pregunta->id_pregunta}}" value="No aplica">
                     No aplica
                     <br>
                @endif
                <br>
                </label>
            </div>
            @endforeach


            <button class ="button btn btn-primary" type="submit" onclick="return (confirm('Una vez respondida la encuesta, no es posible editarla.') && confirm('¿Estás seguro que quieres entregar la encuesta?'))? true:false" > responder </button>
            
            </form>
            

        </div>   

    </section>

    
</body>
</html>
