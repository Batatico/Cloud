<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/ucn.ico" type="image/x-icon">
    <title>Administrar período académico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    
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

      

    <section class="container d-flex py-4 mt-5">
        <!--- Esto existe para separar el título de la nav-bar, sin esto el titulo queda pegado -->
        <div class="container d-flex justify-content-center", style="padding-top:100px; ">
        <h1> Administrar período </h1>

        </div>
    </section>

    <section class="container py-1 mt-1 justify-content-center", style="padding-top:60px; ">
        <div>
            <div class="row justify-content-center">
                <div class="col-6 card justify-content-center">
                    <div class="py-2 mt-2 text-center justify-content-center">
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                       <h3> Habilitar </h3>
                        <form action="{{url('/periodo')}}" method="post">
                            @csrf

                            <!-- CODIGO -->
                          
                            <div class= "container d-block align-content-center">
                             <x-label for="codigo_semestre" :value="__('Código')" />
                            </div>
                            <div class= "container d-block align-content-center" >
                             <x-input id="codigo_semestre" required class="block mt-1 w-full" type="number" name="codigo_semestre"/>
                            </div>

                            <!-- DESCRIPCION -->
                            <div class= "container d-block align-content-center">
                              <x-label for="descripcion" :value="__('Descripcion')" />
                            </div>
                            <div class= "container d-block align-content-center">
                             <x-input id="descripcion" required class="block mt-1 w-full" type="text" name="descripcion"/>
                            </div>
                            <div class= "container flex pt-2">
                            <x-button class="ml-4 btn btn-success" >
                                {{method_field('POST')}}
                                HABILITAR PERIODO
                            </x-button>
                            </div>

                         </form>
                    </div>
                </div>
                <div class="col-6 card justify-content-center">
                    <div class="text-center justify-content-center">
                       <h3> Deshabilitar </h3>
                       
                        <form action="{{route('deshabilitar')}}" method="POST" class="my-2">
                            @csrf
                            
                            {{method_field('GET')}}
                            <!-- CODIGO -->
                            <div class = "container d-block align-content-center">
                             <label for="codigo_semestre" :value="__('Código')">
                            </div>
                            <div class= "container d-block align-content-center" >
                             <input id="codigo_semestre" required class="block mt-1 w-full" type="number" name="codigo_semestre">
                            </div>

                            

                            <div class= "container flex pt-2">
                           
                            <button type="submit" class="btn btn-danger btn-lg" onclick="return (confirm('Estás seguro que quieres deshabilitar el periodo?') && confirm('Estás seguro que quieres deshabilitar el periodo?'))? true:false">
                                DESHABILITAR PERIODO
                            </button>
                            </div>

                         </form>
                    </div>



                </div>

            </div>
        </div>
    </section>

    <div class="container col-12 card-header py-2 mt-2 text-center justify-content-center">
        <h3>Periodos Académicos</h3>

    </div>

    <section class = "d-flex py-2 mt-2 justify-content-center">

        <div class= " d-flex justify-content-center scrollable" id="bg">

        <table  class="table table-responsive table-bordered" , border ="2">
        <thead>
            <tr>
                <td>Código de semestre</td>
                <td>Descripción</td>
                <td>Estado</td>




            <tr>
            @foreach ($periodos as $periodo)
            <tr>

                <td>{{$periodo['codigo_semestre']}}</td>
                <td>{{$periodo['descripcion']}}</td>
                @if($periodo->estado==1)
                    
                <td>Habilitado</td>
                @else
                <td>Deshabilitado</td>
                @endif
        
            </tr>
            @endforeach
        </thead>
        </table>

        </div>
    </section>
</body>
</html>
