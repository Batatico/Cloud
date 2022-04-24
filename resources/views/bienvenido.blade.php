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
        <title>Plataforma Ayudantes</title>
    </head>   
    
    <!-- Barra de navegación que muestra logo, opciones como webmail, servicios, telefonos ucn, plataforma etc. -->

<body>

  <nav class ="navbar navbar-light navbar-expand-md fixed-top" style ="background-color: #003057"  >
    <div class="container" >
     <a href="localhost:8000" class="navbar-brand">
      <img src="images/logo_ucn_fondo_oscuro.png" alt="Logo UCN" width="350px" height="auto">
     </a>
         

     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-principal" aria-controls="menu-principal" aria-expanded="false" aria-label="Desplegar menú de navegación">
       <span class="navbar-toggler-icon"></span>

     </button>

    <div class="collapse navbar-collapse" id="menu-principal">
      <ul class="navbar-nav" style="margin-left: auto;">
        <li class="nav-item"> <a href="https://youtube.com/playlist?list=PLvDJqlCwWP_xnzKmmo2T5j59POonRiVGz" class= "nav-link", style="color:#fff">How To</a> </li>
        <li class="nav-item"> <a href="https://ssb.ucn.cl/PROD/twbkwbis.P_WWWLogin" class="nav-link", style="color:#fff" >Mi Portal</a></li>
        <li class="nav-item"> <a href="https://online.ucn.cl/onlineUcn/" class="nav-link", style="color:#fff">Online UCN</a></li>
        <li class="nav-item"> <a href="https://www.gmail.com/" class="nav-link", style="color:#fff">Webmail</a></li>
        <li class="nav-item"> <a href="https://www.ucn.cl/servicios-ucn/" class="nav-link", style="color:#fff">Servicios</a></li>
        <li class="nav-item"> <a href="http://online.ucn.cl/directoriotelefonicoemail/Default.aspx?ind=func" class="nav-link", style="color:#fff">Directorio Telefónico</a></li>
        <li class="nav-item"> <a href="https://www.ucn.cl/contacto/" class="nav-link", style="color:#fff">Contacto</a></li>
        <li class="nav-item"> <a href="https://campusvirtual.ucn.cl/" class= "nav-link", style="color:#fff">Campus Virtual</a> </li>
        
      </ul>      
     </div>
    </div>
  </nav>

  <!-- Sección que muestra el carrusel en funcionamiento, las imagenes deben tener todas la MISMA resolución -->

  <section class="Ayudantes py-4 mt-5">
    <div id="Carrusel" class="carousel slide carousel-fade" data-ride="carousel">
   
    <div class="carousel-inner cointainer">
      <div class="row">  <!-- no tocar esto, el slide se daña -->
        <div class ="col-12 carousel-item active">
          <img src="images/2.jpg" alt="Plataforma Ayudantes" class="d-block w-100">
        </div>
        <div class ="col-12 carousel-item">
          <img src="images/USARESTA.jpg" class = "d-block w-100" alt="Plataforma Ayudantes"> 
        </div>
       </div>
     </div>
   </div>
   </section>

   <!-- Sección que muestra detalles de la página acá puede agregarse cualquier info. --> 

   <section>
       <div class=" container">
           <div class="row">
    <h1 class ="text-center mt-3"> Bienvenido a la Ayudantia Virtual UCN  </h1>
           </div>
        

</div>

   </section>
   <section>
 
    <div class="container-fluid d-flex mt-4">
        <div class="row">
 
         <div class = "col-md-6">
                       
         <p class="justify-content">Un ayudante de la UCN tiene como obligación guiar por el sendero del bien a los alumnos de una determinada asignatura. El objetivo de nuestra universidad es capacitar tanto a alumnos como a profesores, siendo ambos igual de importantes, a que tengan el conocimiento necesario y las herramientas adecuadas, para poder realizar clases de ayudantía, responder dudas y/o consultas del alumnado y también realizar diversas actividades para el profesor que representa, asignar talleres o corregir pruebas cortas. </p>
                
         </div>

         <div class =" col-md-6 align-self-end embed-responsive embed-responsive-1by1 ">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/JITmXATxmVY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
         </div>
         



        </div>
        
    </div>
        <div class="container-fluid mt-4">     
 
         <div class = "col-12 ">
            
           <a href="{{ route("login")}}" class="btn btn-primary btn-lg">Iniciar Sesión</a> 
         </div>
         
        </div>
          
    </div> 
    </section> 
 
    </section>
    <section>
    </section>
    
    
    <!-- Archivos bootstrap JAVASCRIPT -->  
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>  
</html>
