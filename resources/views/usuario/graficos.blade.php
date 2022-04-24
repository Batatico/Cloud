<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="images/ucn.ico" type="image/x-icon">
    <title>Graficos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    
  </head>

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
    
  <body>
    
 
    <div class="container mt-5", style="padding-top:150px; ">
    @if (session('error'))
            <div class="alert alert-danger" role="alert">
            {{ session('error') }}
            </div>
        @endif

        @if(session()->has('status'))
            <p class="alert alert-success">{{session('status')}}</p>
        @endif
        <div class="row">
            <div class="col">
              <div id="container"></div>  
            </div>
        </div>
    </div>

    
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/module/exporting.js"></script>
    <script src="https://code.highcharts.com/module/export-data.js"></script>
    <script src="https://code.highcharts.com/module/accessibility.js"></script>
   
<script> 

Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Porcentaje de alumnos que han respondido las encuesta con respecto del total de alumnos de ese semestre'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'Porcentaje',
        colorByPoint: true,
        data: <?= $data ?>
    }]
});


</script>

<section class = "d-flex justify-content-center", style="padding-top:150px; ">

    <div class= "container flex" id="bg">
        <div>
            <h4 style="text-align:center" >ASIGNATURAS SIN ENCUESTAS ACTIVAS </h4>
            <table border ="1 " class ="table table-hover table-bordered table-responsive">
            
                <thead style = "background-color: #0FA6EE">
                    <tr>
                        <th>NRC de asignaturas</th>

                    </tr>

                </thead>

                <tbody>
                    @foreach($data2 as $data)
                    <tr style = "background-color: #0FA6EE">
                        <th>{{$data->nrc_asignatura}} </th>

                    </tr>
                    @endforeach


                </tbody>

            </table>
        </div>

    </div>
    
    <div class= "container flex" id="bg">
    
        <div>

            <h4 style="text-align:center" >ASIGNATURAS CON ENCUESTAS ACTIVAS SIN RESPUESTAS </h4>
            <table border ="1 " class ="table table-hover table-bordered ">
            
                <thead style = "background-color: #0FA6EE">
                    <tr class"container flex col-6">
                        <th>NRC de asignaturas</th>

                    </tr>

                </thead>

                <tbody>
                    @foreach($data3 as $data)
                    <tr style = "background-color: #0FA6EE">
                        <th>{{$data->nrc_asignatura}}</th>
                    

                    </tr>
                    @endforeach


                </tbody>

            </table>
        </div>

    </div>
</section>

<section>

    <br></br>
    <br></br>
    <h3 style="text-align:center" > Visualizar indicadores por asignatura </h3>

    
    
    <div class= " container flex justify-content-center scrollable" id="bg">

        <table  class="table table-responsive table-bordered" , border ="2">
        <thead>
            <tr>
                
                <td class="col-3">nrc</td>
                <td class="col-3">Opciones</td>
                





            <tr>
        @foreach ($data4 as $data)
            <tr>

                <td>{{$data->nrc}}</td>
                <td>                            
                    <form action="{{route('Das4',$data->nrc)}}" method="post">
                    @csrf
                    {{method_field ('GET')}}
                                                        
                    <button class = "btn btn-warning" type="submit"> Visualizar </button>
                                            
                    </form>
                </td>

            </tr>
        @endforeach
        </thead>
        </table>

        </div>



    <br></br>
    <br></br>
    <h3 style="text-align:center" > Visualizar indicadores por ayudantes </h3>

    <div class= " container flex justify-content-center scrollable" id="bg">

        <table  class="table table-responsive table-bordered" , border ="2">
        <thead>
            <tr>
                
                <td>Rut ayudante</td>
                <td>Nombre del ayudante</td>
                <td>Opciones</td>

            <tr>
        @foreach ($data5 as $data)
            <tr>

                <td>{{$data->rut_alumno}}</td>
                <td>{{$data->nombre}}</td>


                <td>                            
                    <form action="{{route('Das5', $data->rut_alumno)}}" method="post">
                    @csrf
                    {{method_field ('GET')}}
                                                        
                    <button class = "btn btn-warning" type="submit"> Visualizar </button>
                                            
                    </form>
                </td>

            </tr>
        @endforeach
        </thead>
        </table>

        </div>


    <br></br>
    <br></br>
    <h3 style="text-align:center" > Consolidado por ayudante </h3>

    <div class= " container flex justify-content-center scrollable" id="bg">

        <table  class="table table-responsive table-bordered" , border ="2">
        <thead>
            <tr>
                
                <td>Rut ayudante</td>
                <td>Nombre del ayudante</td>
                <td>Opciones</td>

            <tr>
        @foreach ($data5 as $data)
            <tr>

                <td>{{$data->rut_alumno}}</td>
                <td>{{$data->nombre}}</td>


                <td>                            
                    <form action="{{route('mostrarPeriodos', $data->rut_alumno)}}" method="post">
                    @csrf
                    {{method_field ('GET')}}
                                                        
                    <button class = "btn btn-warning" type="submit"> Visualizar </button>
                                            
                    </form>
                </td>

            </tr>
        @endforeach
        </thead>
        </table>

    </div>

</section>
</body>
</html>